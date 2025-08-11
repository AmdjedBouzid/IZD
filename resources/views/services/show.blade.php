<div class="container">
    <h1>{{ $service->title }}</h1>
    <p><strong>Company:</strong> {{ $service->company->name }}</p>
    <p>{{ $service->description }}</p>
    @if($service->image_path)
        <img src="{{ asset('storage/' . $service->image_path) }}" width="300">
    @endif
    <br><br>
    <a href="{{ route('services.index') }}" class="btn btn-secondary">Back</a>
</div>
