from fastapi import FastAPI, HTTPException
from pydantic import BaseModel
import joblib
import pandas as pd
from sklearn.preprocessing import LabelEncoder
import logging
from typing import Dict, Any, List
from fastapi.middleware.cors import CORSMiddleware


# Initialize FastAPI app
app = FastAPI()
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Or specify your frontend origin
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)
# Load the trained model
model = joblib.load('livestock.pkl')


# Define input data schema
class InputFeatures(BaseModel):
    species: str
    breed: str
    age_group: str
    symptoms_list: str
    key_signs: str


# Load and preprocess dataset
df = pd.read_csv('livestock_clean.csv')
features = ['species', 'breed', 'age_group', 'symptoms_list', 'key_signs']
target = 'disease'
feature_names = ['species', 'breed', 'age_group']
target_name = 'disease'

# Split symptoms and signs into individual binary features
symptoms = df['symptoms_list'].str.get_dummies('|')
signs = df['key_signs'].str.get_dummies(';')
symptom_cols: List[str] = list(symptoms.columns)
sign_cols: List[str] = list(signs.columns)

# Encode features and target
encoders: Dict[str, LabelEncoder] = {}
for col in features + [target]:
    encoder = LabelEncoder()
    df[col] = encoder.fit_transform(df[col].astype(str))
    encoders[col] = encoder

# Create a disease map with encoded labels
disease_map = df.drop_duplicates(subset=[target])[[target, 'recommended_treatment', 'prevention']].set_index(target)


def encode_categorical(input_features: Dict[str, Any], feature_names: List[str], encoders: Dict[str, LabelEncoder]) -> \
List[int]:
    return [encoders[feat].transform([str(input_features[feat])])[0] for feat in feature_names]


def encode_binary(input_str: str, cols: List[str], sep: str) -> List[int]:
    vector = [0] * len(cols)
    if input_str:
        for item in input_str.split(sep):
            item = item.strip()
            if item in cols:
                idx = cols.index(item)
                vector[idx] = 1
    return vector


def diagonise(
        input_features: Dict[str, Any],
        model,
        encoders: Dict[str, LabelEncoder],
        disease_map: pd.DataFrame,
        feature_names: List[str],
        target_name: str,
        symptom_cols: List[str],
        sign_cols: List[str]
) -> Dict[str, Any]:
    try:
        encoded = encode_categorical(input_features, feature_names, encoders)
        symptom_vector = encode_binary(input_features.get('symptoms_list', ''), symptom_cols, '|')
        sign_vector = encode_binary(input_features.get('key_signs', ''), sign_cols, ';')
        final_features = encoded + symptom_vector + sign_vector

        pred = model.predict([final_features])[0]
        disease_name = encoders[target_name].inverse_transform([pred])[0]
        treatment = disease_map.loc[pred, 'recommended_treatment']
        prevention = disease_map.loc[pred, 'prevention']

        return {
            'disease': disease_name,
            'treatment': treatment,
            'prevention': prevention
        }
    except Exception as e:
        logging.error("Diagnosis error: %s", str(e))
        return {'error': str(e)}


@app.post("/diagnose")
def diagnose_endpoint(input_data: InputFeatures):
    logging.info("Received input: %s", input_data)
    input_features = input_data.dict()
    result = diagonise(
        input_features=input_features,
        model=model,
        encoders=encoders,
        disease_map=disease_map,
        feature_names=feature_names,
        target_name=target_name,
        symptom_cols=symptom_cols,
        sign_cols=sign_cols
    )
    logging.info("Diagnosis result: %s", result)
    if 'error' in result:
        raise HTTPException(status_code=400, detail=result['error'])
    return result
