@extends('layouts.admin')
@section('title', 'Contacts')

@section('content')
<div class="container">
    <h1>Contacts</h1>

    @include('contacts._messages')

    <a href="{{ route('contacts.create') }}">Add Contact</a>

    @if($contacts->count())
        <table border="1" cellpadding="6" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Value</th>
                    <th>Name</th>
                    <th>Platform</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->value }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->platform }}</td>
                        <td>
                            <a href="{{ route('contacts.edit', $c) }}">Edit</a> |
                            <form action="{{ route('contacts.destroy', $c) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No contacts found.</p>
    @endif
</div>
@endsection
