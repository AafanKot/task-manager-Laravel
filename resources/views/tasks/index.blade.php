@extends('layouts.app')

@section('content')


<div class="container">
    <h2>Tasks for Project: {{ $project->name }}</h2>

    <a href="{{ route('projects.tasks.create', $project->id) }}" class="btn btn-primary mb-3">+ Add Task</a>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary mb-3">← Back to Projects</a>

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr class="
                @if($task->status == 'todo') table-light
                @elseif($task->status == 'in_progress') table-warning
                @elseif($task->status == 'done') table-success
                @endif
            ">
                <td>{{ $task->title }}</td>
                <td>{{ ucfirst($task->status) }}</td>
                <td>{{ $task->due_date }}</td>
                <td>
                    <a href="{{ route('projects.tasks.show', [$project->id, $task->id]) }}" class="btn btn-sm btn-info">View</a>

                    <a href="{{ route('projects.tasks.edit', [$project->id, $task->id]) }}" 
                    class="btn btn-sm btn-warning @if($task->status == 'done') disabled @endif">
                    Edit
                    </a>

                    <form action="{{ route('projects.tasks.destroy', [$project->id, $task->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach


        </tbody>
       
    </table>
     {{ $tasks->links() }}
</div>
@endsection
