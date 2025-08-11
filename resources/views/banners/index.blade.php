@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Banners</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('banners.create') }}" class="btn btn-primary mb-3">Add New Banner</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($banners as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>
                        @if($banner->image_path)
                            <img src="{{ asset('storage/' . $banner->image_path) }}" width="100">
                        @else
                            No image
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('banners.destroy', $banner) }}" method="POST" onsubmit="return confirm('Delete this banner?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No banners found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
