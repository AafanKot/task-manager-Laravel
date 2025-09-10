@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Project</h2>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" value="{{ old('description') }}" class="form-control"></textarea>
        </div>

       <div class="mb-3">
            <label for="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control">
        </div>


        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="planned">Planned</option>
                <option value="active">Active</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Project</button>
    </form>
</div>
@endsection
