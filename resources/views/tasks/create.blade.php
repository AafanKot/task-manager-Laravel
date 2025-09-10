@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Task</h2>

    <form action="{{ route('projects.tasks.store', $project->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" value="{{ old('title') }}" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="todo">To Do</option>
                <option value="in_progress">In Progress</option>
                <option value="done">Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date ?? '') }}">
        </div>


        <button type="submit" class="btn btn-success">Save Task</button>
    </form>
</div>
@endsection
