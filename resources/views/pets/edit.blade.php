@extends('layouts.app')

@section('title', 'Edit Pet')

@section('content')
    <h2>Edit Pet</h2>
    <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $pet['name']) }}" required>
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="available" {{ old('status', $pet['status']) == 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ old('status', $pet['status']) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ old('status', $pet['status']) == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
            @error('status')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Update Pet</button>
    </form>
@endsection
