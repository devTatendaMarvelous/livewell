<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use App\Models\User;
use App\Models\Livestock;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::with(['user', 'livestock'])->paginate(10);
        return view('reminders.index', compact('reminders'));
    }

    public function create()
    {
        $users = User::all();
        $livestock = Livestock::all();
        return view('reminders.create', compact('users', 'livestock'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'livestock_id' => 'nullable|exists:livestocks,id',
            'type' => 'required|in:vaccination,treatment,general',
            'message' => 'required|string',
            'due_date' => 'required|date',
        ]);

        Reminder::create($validated);
        return redirect()->route('reminders.index')->with('success', 'Reminder created.');
    }

    public function edit(Reminder $reminder)
    {
        $users = User::all();
        $livestock = Livestock::all();
        return view('reminders.edit', compact('reminder', 'users', 'livestock'));
    }

    public function update(Request $request, Reminder $reminder)
    {
        $reminder->update($request->all());
        return redirect()->route('reminders.index')->with('success', 'Reminder updated.');
    }

    public function destroy(Reminder $reminder)
    {
        $reminder->delete();
        return redirect()->route('reminders.index')->with('success', 'Reminder deleted.');
    }
}
