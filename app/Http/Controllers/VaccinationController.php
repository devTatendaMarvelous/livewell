<?php

namespace App\Http\Controllers;

use App\Models\Vaccination;
use App\Models\Livestock;
use App\Models\User;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class VaccinationController extends Controller
{
    public function index()
    {
        $vaccinations = Vaccination::with('livestock')->paginate(10);
        return view('vaccinations.index', compact('vaccinations'));
    }

    public function create()
    {
        $livestock = Livestock::all();
        $vets = User::where('role', 'vet')->get();
        return view('vaccinations.create', compact('livestock', 'vets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'livestock_id' => 'required|exists:livestocks,id',
            'vaccine_name' => 'required|string',
            'scheduled_date' => 'required|date',
            'administered_date' => 'nullable|date',
            'administered_by' => 'nullable|exists:users,id',
            'notes' => 'nullable|string',
        ]);

        Vaccination::create($validated);
        toast('Vaccination created successfully.','success');
        return redirect()->route('vaccinations.index')->with('success', 'Vaccination added successfully.');
    }

    public function show(Vaccination $vaccination)
    {
        return view('vaccinations.show', compact('vaccination'));
    }

    public function edit(Vaccination $vaccination)
    {
        $livestock = Livestock::all();
        $vets = User::where('role', 'vet')->get();
        return view('vaccinations.edit', compact('vaccination', 'livestock', 'vets'));
    }

    public function update(Request $request, Vaccination $vaccination)
    {
        $validated = $request->validate([
            'vaccine_name' => 'required|string',
            'scheduled_date' => 'required|date',
            'administered_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $vaccination->update($validated);
        toast('Vaccination updated successfully.','success');
        return redirect()->route('vaccinations.index')->with('success', 'Vaccination updated.');
    }

    public function destroy(Vaccination $vaccination)
    {
        $vaccination->delete();
        toast('Vaccination deleted successfully.','success');
        return redirect()->route('vaccinations.index')->with('success', 'Vaccination deleted.');
    }
}
