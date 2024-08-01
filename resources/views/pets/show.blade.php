@extends('layouts.app')

@section('title', 'Pet Details')

@section('content')
    <h2>Pet Details</h2>
    <div>
        <strong>ID:</strong> {{ $pet['id'] }}
    </div>
    <div>
        <strong>Name:</strong> {{ $pet['name'] }}
    </div>
    <div>
        <strong>Status:</strong> {{ $pet['status'] }}
    </div>
    <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
    <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display: inline;">
        @csrf
        @method('DELETE')
        <button type="submit">Delete</button>
    </form>
@endsection
