
<div class="container">
    <h1>Edit Service</h1>

    <form action="{{ route('services.update', $service) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Company</label>
            <select name="company_id" class="form-control">
                @foreach($companies as $company)
                    <option value="{{ $company->id }}" @selected($company->id == $service->company_id)>{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="{{ $service->title }}" class="form-control">
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control">{{ $service->description }}</textarea>
        </div>
        <div class="form-group">
            <label>Image</label><br>
            @if($service->image_path)
                <img src="{{ asset('storage/' . $service->image_path) }}" width="100"><br>
            @endif
            <input type="file" name="image_path" class="form-control">
        </div>
        <button class="btn btn-success mt-2">Update</button>
    </form>
</div>

