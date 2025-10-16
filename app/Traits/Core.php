<?php

namespace App\Traits;

trait Core
{


    function getSpecies(){
        return ['Sheep' ,'Poultry', 'Cattle', 'Pig', 'Goat', 'Dog'];
    }
    function getBreeds(){
        return [
            "Merino",
            "Indigenous",
            "Angus",
            "Local",
            "Hereford",
            "Dorper",
            "Friesian",
            "Broilers",
            "Katahdin",
            "Boer",
            "Sanga",
            "Bonsmara",
            "Layers",
            "Boer cross",
            "Bali",
            "Kalahari",
            "Local scavenging",
            "Brahman",
            "Berkshire",
            "Large White",
            "Landrace",
            "Crossbreed",
            "Purebred",
            "Commercial layers",
            "Domestic"
        ];
    }

    function getAges()
    {
        return [
            "Adult",
            "Neonate",
            "Juvenile",
            "Senior",
            "Calf",
        ];
    }

   function getSigns() {
       $filePath = public_path('signs.json');
       if (!file_exists($filePath)) {
           return [];
       }

       $jsonData = file_get_contents($filePath);
       $data = json_decode($jsonData, true);

       if ($data === null) {
           return [];
       }

       $signs = [];
       foreach ($data as $item) {
           if (isset($item['key_signs'])) {
               $parts = explode(';', $item['key_signs']);
               foreach ($parts as $sign) {
                   $signs[] = trim($sign);
               }
           }
       }

       return array_values(array_unique($signs));
   }



    function getSymptoms()
    {
        $filePath = public_path('symptoms.json');
        if (!file_exists($filePath)) {
            return [];
        }

        $jsonData = file_get_contents($filePath);
        $data = json_decode($jsonData, true);

        if ($data === null) {
            return [];
        }

        $symptoms = [];
        foreach ($data as $item) {
            if (isset($item['symptoms_list'])) {
                $parts = explode('|', $item['symptoms_list']);
                foreach ($parts as $symptom) {
                    $symptoms[] = trim($symptom);
                }
            }
        }

        return array_values(array_unique($symptoms));
    }

}
