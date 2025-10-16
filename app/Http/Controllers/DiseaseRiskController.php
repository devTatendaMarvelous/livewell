<?php

namespace App\Http\Controllers;

use App\Models\DiseaseRisk;
use Illuminate\Http\Request;

class DiseaseRiskController extends Controller
{
    public function index()
    {
        $risks = DiseaseRisk::latest()->paginate(10);
        return view('disease_risks.index', compact('risks'));
    }

    public function create()
    {
        return view('disease_risks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'region' => 'required|string',
            'disease_name' => 'required|string',
            'risk_level' => 'required|in:low,medium,high',
            'source' => 'nullable|string',
            'forecast_date' => 'nullable|date',
        ]);

        DiseaseRisk::create($validated);
        toast('Risk created successfully.','success');
        return redirect()->route('disease-risks.index')->with('success', 'Disease risk added.');
    }

    public function edit(DiseaseRisk $diseaseRisk)
    {
        return view('disease_risks.edit', compact('diseaseRisk'));
    }

    public function update(Request $request, DiseaseRisk $diseaseRisk)
    {
        $validated = $request->validate([
            'region' => 'required|string',
            'disease_name' => 'required|string',
            'risk_level' => 'required|in:low,medium,high',
            'source' => 'nullable|string',
            'forecast_date' => 'nullable|date',
        ]);

        $diseaseRisk->update($validated);
        toast('Risk updated successfully.','success');
        return redirect()->route('disease-risks.index')->with('success', 'Record updated.');
    }

    public function destroy(DiseaseRisk $diseaseRisk)
    {
        $diseaseRisk->delete();
        toast('Risk deleted successfully.','success');
        return redirect()->route('disease-risks.index')->with('success', 'Record deleted.');
    }
}
