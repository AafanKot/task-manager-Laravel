@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Task</h2>

    <form action="{{ route('projects.tasks.update', [$project->id, $task->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" class="form-control" value="{{ $task->title }}" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" value="{{ old('description') }}" class="form-control">{{ $task->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="todo" @if($task->status == 'todo') selected @endif>To Do</option>
                <option value="in_progress" @if($task->status == 'in_progress') selected @endif>In Progress</option>
                <option value="done" @if($task->status == 'done') selected @endif>Done</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}">
        </div>


        <button type="submit" class="btn btn-success">Update Task</button>
    </form>
</div>
@endsection
