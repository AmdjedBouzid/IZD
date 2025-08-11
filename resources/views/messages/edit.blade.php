@extends('layouts.app')

@section('content')
    <h1>Edit Message</h1>

    <form action="{{ route('messages.update', $message->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>From</label>
        <input type="text" name="from" value="{{ old('from', $message->from) }}">

        <label>Object</label>
        <input type="text" name="object" value="{{ old('object', $message->object) }}">

        <label>Content</label>
        <textarea name="content">{{ old('content', $message->content) }}</textarea>

        <button type="submit">Update</button>
    </form>
@endsection
