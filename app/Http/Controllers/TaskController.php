<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Show all tasks for a project with pagination
    public function index(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Pagination: 5 tasks per page, ordered by due_date ascending
        $tasks = $project->tasks()->orderBy('due_date', 'asc')->paginate(5);

        return view('tasks.index', compact('project', 'tasks'));
    }

    // Show create task form
    public function create(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.create', compact('project'));
    }

    // Store new task
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:255',
            'description' => 'required|min:5|max:400',
            'status' => 'required|string|in:todo,in_progress,done',
            'due_date' => 'required|date|after_or_equal:today',
        ], [
            'title.required' => 'Task title is required.',
            'description.required' => 'Project Description is required.',
            'status.required' => 'Please select task status.',
            'status.in' => 'Status must be todo, in_progress, or done.',
            'due_date.required' => 'Due date is required.',
            'due_date.after_or_equal' => 'Due date cannot be in the past.',
        ]);

        $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('projects.tasks.index', $project->id)
                         ->with('success', 'Task created successfully!');
    }

    // Show single task
    public function show(Project $project, Task $task)
    {
        if ($project->user_id !== Auth::id() || $task->project_id !== $project->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.show', compact('project', 'task'));
    }

    // Edit form
    public function edit(Project $project, Task $task)
    {
        if ($project->user_id !== Auth::id() || $task->project_id !== $project->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.edit', compact('project', 'task'));
    }

    // Update task
    public function update(Request $request, Project $project, Task $task)
    {
        if ($project->user_id !== Auth::id() || $task->project_id !== $project->id) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:todo,in_progress,done',
            'due_date' => 'required|date',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('projects.tasks.index', $project->id)
                         ->with('success', 'Task updated successfully!');
    }

    // Delete task
    public function destroy(Project $project, Task $task)
    {
        if ($project->user_id !== Auth::id() || $task->project_id !== $project->id) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('projects.tasks.index', $project->id)
                         ->with('success', 'Task deleted successfully!');
    }
}
