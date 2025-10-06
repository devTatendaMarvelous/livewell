<?php

namespace App\Http\Controllers;

use App\Models\Livestock;
use App\Models\User;
use Illuminate\Http\Request;

class LivestockController extends Controller
{
    public function index()
    {
        $livestock = Livestock::with('user')->latest()->paginate(10);
        return view('livestock.index', compact('livestock'));
    }

    public function create()
    {
        $farmers = User::where('role', 'farmer')->get();
        return view('livestock.create', compact('farmers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'tag_number' => 'required|unique:livestocks,tag_number',
            'species' => 'required|string',
            'breed' => 'nullable|string',
            'age' => 'nullable|integer',
            'sex' => 'nullable|in:male,female',
            'weight' => 'nullable|numeric',
        ]);

        Livestock::create($validated);
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
        return redirect()->route('livestock.index')->with('success', 'Livestock updated successfully.');
    }

    public function destroy(Livestock $livestock)
    {
        $livestock->delete();
        return redirect()->route('livestock.index')->with('success', 'Livestock deleted successfully.');
    }
}
