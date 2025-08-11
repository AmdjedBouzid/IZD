@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Company</h1>

    @if($errors->has('general'))
        <div style="color: red;">{{ $errors->first('general') }}</div>
    @endif

    <form action="{{ route('companies.store') }}" method="POST">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        {{-- <div>
            <label>Huge Title:</label>
            <input type="text" name="huge_title" value="{{ old('huge_title') }}">
            @error('huge_title') <div style="color: red;">{{ $message }}</div> @enderror
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description">{{ old('description') }}</textarea>
            @error('description') <div style="color: red;">{{ $message }}</div> @enderror
        </div> --}}
        <button type="submit">Save</button>
    </form>
</div>
@endsection
