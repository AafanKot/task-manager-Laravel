<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // Show all projects of logged-in user
    public function index()
    {
        // $projects = Project::where('user_id', Auth::id())->get();
        $projects = Project::where('user_id', Auth::id())->orderBy('created_at','desc')->paginate(5);

        return view('projects.index', compact('projects'));
    }

    // Show create form
    public function create()
    {
        return view('projects.create');
    }

    // Store new project
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:200',
            'description' => 'required|min:5|max:400',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:planned,active,completed',
        ], [
            'name.required' => 'Project name is required.',
            'description.required' => 'Project Description is required.',
            'start_date.required' => 'Start date is required.',
            'end_date.required' => 'End date is required.',
            'end_date.after_or_equal' => 'End date must be the same or after the start date.',
            'status.required' => 'Please select project status.',
            'status.in' => 'Status must be planned, active, or completed.'
        ]);

        Project::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully!');
}

    // Show a single project
    public function show(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('projects.show', compact('project'));
    }

    // Edit form
    public function edit(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        return view('projects.edit', compact('project'));
    }

    // Update project
    public function update(Request $request, Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|string|in:planned,active,completed',
        ]);

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status ?? $project->status, // keep old if empty
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }


    // Delete project
    public function destroy(Project $project)
    {
        if ($project->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}
