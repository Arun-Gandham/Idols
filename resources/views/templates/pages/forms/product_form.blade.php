@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "Product Form")

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
        /* width: 13.25rem; */
        margin: 0px auto;
        width: 100%;
        height: 18rem;
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

    @media only screen and (max-width: 600px) {
        .image-outer {
            height: unset;
        }

        .image-outer img {
            max-width: 7rem !important;
        }
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
            <form class="card-body" method="POST" action="{{ isset($product) ? route('product.edit.submit') : route('product.add.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <div class="image-outer">
                            <label for="imageUpload" id="uploadButton" style="{{ isset($product->thumbnail) ? 'display:none' : '' }}" class="button">Upload
                                Profile Picture</label>
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
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Name</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ isset($product) ? $product->name : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Feet</label>
                                <div class="col-sm-11">
                                    <select class="form-select" name="feet_id" required="">
                                        @foreach ($feets as $feet)
                                        <option {{ isset($product) && $feet->id === $product->feet_id ? 'selected' : '' }} value="{{ $feet->id }}">{{ $feet->feet }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Type</label>
                                <div class="col-sm-11">
                                    <select class="form-select" name="type_id" required="">
                                        @foreach ($types as $type)
                                        <option {{ isset($product) && $type->id === $product->type_id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Price</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Price" name="price" value="{{ isset($product) ? $product->price : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Body
                                    Color</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" placeholder="Body Color" name="body_color" value="{{ isset($product) ? $product->body_color : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Pancha/Saree
                                    Color</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" placeholder="Pancha/Saree Color" name="pancha_saree_color" value="{{ isset($product) ? $product->pancha_saree_color : '' }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Stock</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Stock" name="stock" value="{{ isset($product) ? $product->stock : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Images</label>
                                <div class="col-sm-11">
                                    <input type="file" multiple="multiple" accept="image/*" class="form-control" name="images[]">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Model Year</label>
                                <div class="col-sm-11">
                                    <select class="form-select" name="model" required="">
                                        @foreach ($models as $year)
                                        <option {{ isset($product) ? ($product->model == $year ? 'selected' : '') : (date('Y') === $year ? 'selected' : '' ) }} value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Description</label>
                                <div class="col-sm-11">
                                    <textarea class="form-control" placeholder="Say it" rows="3" required name="description">{{ isset($product) ? $product->description : '' }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="col-sm-9 mt-3">
                                    <label class="switch switch-success">
                                        <input type="checkbox" class="switch-input" name="status" {{ isset($product) ? ($product->status === 1 ? 'checked' : '') : 'checked' }} />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on">
                                                <i class="ti ti-check"></i>
                                            </span>
                                            <span class="switch-off">
                                                <i class="ti ti-x"></i>
                                            </span>
                                        </span>
                                        <span class="switch-label">Status</span>
                                    </label>
                                </div>
                            </div>
                            <div class="pt-4">
                                <div class="row justify-content-start">
                                    <div class="col-sm-11">
                                        <input type="hidden" name="id" value="{{ isset($product) ? $product->id : null }}">
                                        <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light"><i class='fa-solid fa-{{ isset($product) ? "cloud-arrow-up" : "save" }}'></i> &nbsp; {{ isset($product) ? 'Update' : 'Save' }}</button>
                                        <button class="btn btn-label-secondary waves-effect" type="button"><a href="{{ route('product.list') }}">Cancel</a></button>
                                    </div>
                                </div>
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
                imagePreview.innerHTML = `<div class='d-flex flex-column'><img src="${imageUrl}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                 <button class='removeButton' id="removeButton">Remove</button></div>`;

                document.getElementById('removeButton').addEventListener('click', function() {
                    document.getElementById('imageUpload').value = '';
                    imagePreview.innerHTML = '';
                    document.getElementById('uploadButton').style.display = 'inline-block';
                });
            }
            reader.readAsDataURL(file);
            document.getElementById('uploadButton').style.display = 'none';
        }
    });
</script>
@endsection