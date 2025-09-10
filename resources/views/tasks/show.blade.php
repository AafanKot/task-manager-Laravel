@extends('layouts.app')

@section('content')
<h1>Task Details</h1>

<div class="card">
    <div class="card-body">
        <h3>{{ $task->title }}</h3>
        <p><strong>Status:</strong> {{ ucfirst($task->status) }}</p>
        <p><strong>Description:</strong> {{ $task->description ?? 'No description' }}</p>
        <p><strong>Due Date:</strong> {{ $task->due_date ?? 'Not set' }}</p>
    </div>
</div>

<a href="{{ route('projects.tasks.index', $project) }}" class="btn btn-secondary mt-3">← Back to Tasks</a>
@endsection
