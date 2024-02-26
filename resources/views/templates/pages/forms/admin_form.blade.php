@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

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
                <form class="card-body" method="POST"
                    action="{{ isset($user) ? route('admin.edit.submit') : route('admin.add.submit') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="image-outer">
                                <label for="imageUpload" id="uploadButton" class="button">Profile Picture</label>
                                <input type="file" id="imageUpload" accept="image/*" style="display: none;" required>
                                <div id="imagePreview" class="image-preview"></div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">User Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="multicol-username" class="form-control"
                                            placeholder="User Name" name="username"
                                            value="{{ isset($user) ? $user->name : '' }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" id="multicol-username" class="form-control"
                                            placeholder="Email" name="email"
                                            value="{{ isset($user) ? $user->email : '' }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Password</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="id" value="{{ isset($user) ? $user->id : '' }}">
                                        <input type="text" id="multicol-username" class="form-control"
                                            placeholder="password" name="password" {{ isset($user) ? '' : 'required' }}>
                                    </div>
                                </div>

                                <div class="pt-4">
                                    <div class="row justify-content-start">
                                        <div class="col-sm-9">
                                            <button type="submit"
                                                class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($user) ? 'Update' : 'Submit' }}</button>
                                            <button class="btn btn-label-secondary waves-effect"><a
                                                    href="{{ route('admin.list') }}">Cancel</a></button>
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
