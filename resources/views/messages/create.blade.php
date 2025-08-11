@extends('layouts.app')

@section('content')
    <h1>Create Message</h1>

    @error('error')
        <div style="color: red">{{ $message }}</div>
    @enderror

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <label>From</label>
        <input type="text" name="from" value="{{ old('from') }}">
        @error('from') <div style="color: red">{{ $message }}</div> @enderror

        <label>Object</label>
        <input type="text" name="object" value="{{ old('object') }}">
        @error('object') <div style="color: red">{{ $message }}</div> @enderror

        <label>Content</label>
        <textarea name="content">{{ old('content') }}</textarea>
        @error('content') <div style="color: red">{{ $message }}</div> @enderror

        <button type="submit">Save</button>
    </form>
@endsection
