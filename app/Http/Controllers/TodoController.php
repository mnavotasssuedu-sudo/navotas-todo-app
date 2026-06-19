<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

// Make sure it extends the base Controller correctly
class TodoController extends Controller
{
    // Require login for all todo actions
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show only the logged-in user's todos
    public function index(): View
    {
        $todos = auth()->user()->todos()->latest()->get();
        return view('todos.index', compact('todos'));
    }

    // Save new todo
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['is_completed'] = false;

        Todo::create($validated);

        return redirect()->route('todos.index')->with('success', 'Task added successfully!');
    }

    // Toggle complete status
    public function toggle(Todo $todo): RedirectResponse
    {
        if ($todo->user_id !== auth()->id()) abort(403);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();
        return redirect()->route('todos.index')->with('success', 'Task updated!');
    }

    // Delete todo
    public function destroy(Todo $todo): RedirectResponse
    {
        if ($todo->user_id !== auth()->id()) abort(403);
        $todo->delete();
        return redirect()->route('todos.index')->with('success', 'Task deleted!');
    }
}