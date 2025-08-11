@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Companies</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($errors->has('general'))
        <div style="color: red;">{{ $errors->first('general') }}</div>
    @endif

    <a href="{{ route('companies.create') }}">+ Add Company</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Huge Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->huge_title }}</td>
                    <td>{{ $company->description }}</td>
                    <td>
                        <a href="{{ route('companies.edit', $company) }}">Edit</a>
                        <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Delete this company?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No companies found.</td></tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
