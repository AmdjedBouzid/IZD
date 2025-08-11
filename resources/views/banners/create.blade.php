@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Banner</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="image_path" class="form-label">Banner Image</label>
            <input type="file" name="image_path" id="image_path" class="form-control">
            @error('image_path')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection
