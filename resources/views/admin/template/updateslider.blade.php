@extends('admin.master')

@section('title', 'Dashboard')


 
@section('content')
<div class="container my-5">
    <!-- Form Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Cập nhật Slider</h3>
        <a href="{{ route('listsliders') }}" class="btn btn-secondary d-flex align-items-center"><i class="bi bi-x-sm me-2"></i>quay lại</a>
    </div>
    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <!-- Card containing form -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('slider.update', ['id' => $updateslider->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                <!-- Title Field -->
                <div class="mb-3">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $updateslider->title) }}" required>
                </div>

                <!-- Description Field -->
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description">{{ old('description', $updateslider->description) }}</textarea>
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                    <label for="image" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" id="image" name="image">
                    <div class="mt-2">
                        @if ($updateslider->image)
                        <img src="{{ asset('img/images/' . $updateslider->image) }}" alt="Preview" class="img-thumbnail">
                        @endif
                    </div>
                </div>

                <!-- Link Field -->
                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="url" class="form-control" id="link" name="{{ old('link', $updateslider->link) }}" >
                </div>

                <!-- Display Checkbox -->
                <div class="form-check mb-3">
                    <label class="form-check-label" for="display">Trạng thái</label>
                    <input type="hidden" name="is_active" value="0">   
                    <input class="form-check-input" type="checkbox" id="display" value="1" name="is_active" {{ $updateslider->is_active ? 'checked' : '' }}>
                    
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <button class="btn btn-primary btn-md"><i class="bi bi-save me-2"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection