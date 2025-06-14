<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch tasks for the authenticated user
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Auth::user()->tasks()->create($request->only('title'));
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('tasks.edit', compact('task'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if($task->user_id !== Auth::id())
        {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
       $task->update($request->only('title', 'is_done'));
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if($task->user_id !== Auth::id())
        {
            abort(403, 'Unauthorized action.');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
