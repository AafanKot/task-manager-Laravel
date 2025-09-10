@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Project</h2>

    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" value="{{ $project->name }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" value="{{ old('description') }}" class="form-control">{{ $project->description }}</textarea>
        </div>

       <div class="mb-3">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $project->start_date }}">
        </div>

        <div class="mb-3">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $project->end_date }}">
        </div>


        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="planned" @if($project->status == 'planned') selected @endif>Planned</option>
                <option value="active" @if($project->status == 'active') selected @endif>Active</option>
                <option value="completed" @if($project->status == 'completed') selected @endif>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Project</button>
    </form>
</div>
@endsection
