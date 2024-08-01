@extends('layouts.app')

@section('title', 'Add New Pet')

@section('content')
    <h2>Add New Pet</h2>
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
            @error('status')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Add Pet</button>
    </form>
@endsection
