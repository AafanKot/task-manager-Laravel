@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>My Projects</h2>

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">+ Add Project</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr class="
                @if($project->status == 'planned') table-secondary
                @elseif($project->status == 'active') table-info
                @elseif($project->status == 'completed') table-success
                @endif
            ">
                <td>{{ $project->name }}</td>
                <td>{{ ucfirst($project->status) }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>
                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-warning @if($project->status == 'completed') disabled @endif">Edit</a>
                    <a href="{{ route('projects.tasks.index', $project->id) }}" class="btn btn-sm btn-primary">Tasks</a>
                    <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this project?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    
    </table>
    {{ $projects->links() }}
</div>
@endsection
