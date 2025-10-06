<?php

namespace App\Http\Controllers;

use App\Models\HealthRecord;
use App\Models\Livestock;
use App\Models\User;
use Illuminate\Http\Request;

class HealthRecordController extends Controller
{
    public function index()
    {
        $records = HealthRecord::with(['livestock', 'vet'])->latest()->paginate(10);
        return view('health_records.index', compact('records'));
    }

    public function create()
    {
        $livestock = Livestock::all();
        $vets = User::where('role', 'vet')->get();
        return view('health_records.create', compact('livestock', 'vets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'livestock_id' => 'required|exists:livestocks,id',
            'symptoms' => 'required|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'vet_id' => 'nullable|exists:users,id',
            'recorded_at' => 'nullable|date',
        ]);

        HealthRecord::create($validated);
        return redirect()->route('health-records.index')->with('success', 'Health record created.');
    }

    public function show(HealthRecord $healthRecord)
    {
        return view('health_records.show', compact('healthRecord'));
    }

    public function edit(HealthRecord $healthRecord)
    {
        $livestock = Livestock::all();
        $vets = User::where('role', 'vet')->get();
        return view('health_records.edit', compact('healthRecord', 'livestock', 'vets'));
    }

    public function update(Request $request, HealthRecord $healthRecord)
    {
        $validated = $request->validate([
            'symptoms' => 'required|string',
            'diagnosis' => 'nullable|string',
            'treatment' => 'nullable|string',
            'vet_id' => 'nullable|exists:users,id',
            'recorded_at' => 'nullable|date',
        ]);

        $healthRecord->update($validated);
        return redirect()->route('health-records.index')->with('success', 'Record updated successfully.');
    }

    public function destroy(HealthRecord $healthRecord)
    {
        $healthRecord->delete();
        return redirect()->route('health-records.index')->with('success', 'Record deleted.');
    }
}
