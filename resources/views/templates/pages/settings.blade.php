@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "Admin Form")

@section('content')

<style>
    .button {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }

    .image-preview {
        text-align: center;
        margin-top: 20px;
    }

    .preview-image {
        max-width: 100%;
        max-height: 200px;
        margin-bottom: 10px;
    }

    .remove-button {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 8px 15px;
        cursor: pointer;
        border-radius: 5px;
    }

    .image-outer {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        border: 2px dashed #dbdade;
        border-radius: 0.5rem;
        width: 13.25rem;
        margin: 0px auto
    }

    .image-outer img {
        max-height: 100%;
        max-width: 100%;
    }

    .removeButton {
        color: #6f6b7d;
        border-top: 1px solid #dbdade;
        border-bottom-right-radius: calc(0.375rem - 1px);
        border-bottom-left-radius: calc(0.375rem - 1px);
        display: block;
        text-align: center;
        padding: 0.375rem 0;
        font-size: 0.75rem;
        width: 80%;
        margin: 10px;
        background: #fff;
    }
</style>
@if ($error = session('error'))
<div class="alert alert-danger d-flex align-items-center alert-dismissible" role="alert">
    {{ $error }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>
@endif
@if ($success = session('success'))
<div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
    {{ $success }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    </button>
</div>
@endif


<div class="row">
    <!-- Form Separator -->
    <div class="col">
        <div class="card mb-4">
            <form class="card-body" method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <small>Front Page Settings</small>
                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username">Website Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="multicol-username" class="form-control" placeholder="Name" name="name" value="{{ isset($settings) ? $settings->name : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username">Email</label>
                        <div class="col-sm-9">
                            <input type="email" id="multicol-username" class="form-control" placeholder="Email" name="email" value="{{ isset($settings) ? $settings->email : '' }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="text" id="multicol-username" class="form-control" placeholder="Phone" name="phone" value="{{ isset($settings) ? $settings->phone : '' }}" required>
                        </div>
                    </div>
                    <!-- <div class="col-md-3">
                        <div class="image-outer d-flex flex-column  p-2">
                            <input type="file" id="imageUpload" name="thumbnail" accept="image/*" style="display: none;" {{ !isset($product) ? 'required' : '' }}>
                            <div id="imagePreview" class="image-preview">
                                @if (isset($product) && $product->thumbnail)
                                <div class='d-flex flex-column'>
                                    <img src="{{ asset($product->thumbnail) }}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                    <label for="imageUpload" id="uploadButton" class="button">Upload Profile
                                        Picture</label>
                                </div>
                                @endif
                            </div>
                            <label for="imageUpload" id="uploadButton" style="{{ isset($product->thumbnail) ? 'display:none' : '' }}" class="button">Logo</label>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="image-outer d-flex flex-column  p-2">
                            <input type="file" id="faviconupload" name="thumbnail" accept="image/*" style="display: none;" {{ !isset($product) ? 'required' : '' }}>
                            <div id="faviconPreview" class="image-preview">
                                @if (isset($product) && $product->thumbnail)
                                <div class='d-flex flex-column'>
                                    <img src="{{ asset($product->thumbnail) }}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                    <label for="imageUpload" id="uploadfavicon" class="button">Upload Profile
                                        Picture</label>
                                </div>
                                @endif
                            </div>
                            <label for="imageUpload" id="uploadfavicon" style="{{ isset($product->thumbnail) ? 'display:none' : '' }}" class="button">Favicon</label>
                        </div>
                    </div> -->
                    <div class="col-md-4">
                        <label class="col-sm-12 col-form-label" for="multicol-username">Model Year</label>
                        <div class="col-sm-11">
                            <select class="form-select" name="model" required="">
                                @foreach ($years as $year)
                                <option {{ isset($settings) ? ($settings->model == $year ? 'selected' : '') : (date('Y') === $year ? 'selected' : '' ) }} value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="col-sm-3 col-form-label" for="multicol-username">Website Description</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" placeholder="Say it" rows="9" required name="description">{{ isset($settings) ? $settings->description : '' }}</textarea>
                        </div>
                    </div>
                    <div class="pt-4">
                        <div class="row justify-content-start">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($user) ? 'Update' : 'Submit' }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('imageUpload').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imageUrl = event.target.result;
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.innerHTML = `<img src="${imageUrl}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">`;
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('faviconupload').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const imageUrl = event.target.result;
                const imagePreview = document.getElementById('faviconPreview');
                imagePreview.innerHTML = `<img src="${imageUrl}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection