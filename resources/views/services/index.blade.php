@extends('layouts.app')
@section('content')

<div class="container">
        <h1>Services</h1>
    <a href="{{ route('services.create') }}" class="btn btn-primary mb-3">Add Service</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Company</th>
                <th>Title</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->company->name }}</td>
                <td>{{ $service->title }}</td>
                <td>
                    @if($service->image_path)
                    <img src="{{ asset('storage/' . $service->image_path) }}" width="80">
                    @endif
                </td>
                <td>
                    <a href="{{ route('services.show', $service) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('services.edit', $service) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('services.destroy', $service) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this service?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection