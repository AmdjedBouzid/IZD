@extends('layouts.app')

@section('content')
    <h1>Messages</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <ul>
        @forelse($messages as $message)
            <li>
                <strong>{{ $message->object }}</strong> (from: {{ $message->from }})<br>
                {{ $message->content }}<br>
                <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @empty
            <li>No messages found.</li>
        @endforelse
    </ul>
@endsection
