@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Service</h1>

    <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Company</label>
            <select name="company_id" class="form-control">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image_path" class="form-control">
        </div>
        <button class="btn btn-success mt-2">Save</button>
    </form>
</div>

@endsection