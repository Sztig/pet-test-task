@extends('layouts.app')

@section('title', 'Pet List')

@section('content')
    <h2>Pet List</h2>

    <form action="{{ route('pets.index') }}" method="GET">
        <label for="status">Filter by status:</label>
        <select name="status" id="status">
            @foreach($statuses as $statusOption)
                <option value="{{ $statusOption }}" {{ $status == $statusOption ? 'selected' : '' }}>
                    {{ ucfirst($statusOption) }}
                </option>
            @endforeach
        </select>
        <button type="submit">Filter</button>
    </form>

    @if(count($pets) > 0)
        <ul>
            @foreach($pets as $pet)
                <li>
                    {{ $pet['name'] ?? 'Unnamed' }}
                    <a href="{{ route('pets.show', $pet['id']) }}">View</a>
                    <a href="{{ route('pets.edit', $pet['id']) }}">Edit</a>
                    <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No pets found.</p>
    @endif
@endsection
