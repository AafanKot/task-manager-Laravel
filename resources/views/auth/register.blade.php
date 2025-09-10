@extends('layouts.app')

@section('content')
<h1>Register</h1>
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Register</button>
</form>

<p class="mt-3">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
@endsection
