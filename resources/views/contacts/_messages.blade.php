@if($errors->has('general'))
    <div style="color: red;">{{ $errors->first('general') }}</div>
@endif

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div style="color: green;">{{ session('success') }}</div>
@endif
