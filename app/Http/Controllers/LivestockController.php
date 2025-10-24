<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use App\Models\User;
use App\Traits\Core;
use Illuminate\Http\Request;

class LivestockController extends Controller
{
    use Core;
    public function index()
    {
        $livestock = Livestock::with('user')->when(!isVet(),function ($query){
            return $query->where('user_id', auth()->user()->id);
        })->latest()->paginate(10);
        return view('livestock.index', compact('livestock'));
    }

    public function create()
    {
        $farmers = User::where('role', 'farmer')->get();
       $ages = $this->getAges();
        $breeds = $this->getBreeds();
        $species = $this->getSpecies();

        return view('livestock.create', compact('farmers', 'ages', 'breeds', 'species'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tag_number' => 'required|unique:livestocks,tag_number',
            'species' => 'required|string',
            'breed' => 'nullable|string',
            'age' => 'nullable',
            'sex' => 'nullable|in:male,female',
            'weight' => 'nullable|numeric',
        ]);

        Livestock::create($validated);
        toast('Livestock added successfully.','success');
        return redirect()->route('livestock.index')->with('success', 'Livestock added successfully.');
    }

    public function show(Livestock $livestock)
    {
        return view('livestock.show', compact('livestock'));
    }

    public function edit(Livestock $livestock)
    {
        $farmers = User::where('role', 'farmer')->get();
        return view('livestock.edit', compact('livestock', 'farmers'));
    }

    public function update(Request $request, Livestock $livestock)
    {
        $validated = $request->validate([
            'species' => 'required|string',
            'breed' => 'nullable|string',
            'age' => 'nullable|integer',
            'sex' => 'nullable|in:male,female',
            'weight' => 'nullable|numeric',
        ]);

        $livestock->update($validated);
        toast('Livestock updated successfully.','success');
        return redirect()->route('livestock.index')->with('success', 'Livestock updated successfully.');
    }

    public function destroy(Livestock $livestock)
    {
        $livestock->delete();
        toast('Livestock deleted successfully.','success');
        return redirect()->route('livestock.index')->with('success', 'Livestock deleted successfully.');
    }
}
