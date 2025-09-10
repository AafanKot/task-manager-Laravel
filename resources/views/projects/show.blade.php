@extends('layouts.app')

@section('content')
<h1>Project Details</h1>

<div class="card">
    <div class="card-body">
        <h3>{{ $project->name }}</h3>
        <p><strong>Description:</strong> {{ $project->description ?? 'No description' }}</p>
        <p><strong>Start Date:</strong> {{ $project->start_date ?? 'Not set' }}</p>
        <p><strong>End Date:</strong> {{ $project->end_date ?? 'Not set' }}</p>
        <p><strong>Status:</strong> {{ ucfirst($project->status ?? 'planned') }}</p>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('projects.edit', $project) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">← Back to Projects</a>
</div>

<hr>

<h2>Tasks in this Project</h2>
<a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary mb-3">+ New Task</a>

@if($project->tasks->count())
    <ul class="list-group">
        @foreach($project->tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('projects.tasks.show', [$project, $task]) }}">
                    {{ $task->title }} ({{ ucfirst($task->status) }})
                </a>
                <div>
                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('projects.tasks.destroy', [$project, $task]) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p>No tasks yet for this project.</p>
@endif
@endsection
