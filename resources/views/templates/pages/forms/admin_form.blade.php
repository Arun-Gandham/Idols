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
                <form class="card-body" method="POST"
                    action="{{ isset($user) ? route('users.edit.submit') : route('users.add.submit') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="image-outer">
                                    <label for="imageUpload" id="uploadButton" style="{{ isset($user->photo) ? 'display:none' : '' }}" class="button">Upload Profile Picture</label>
                               
                                <input type="file" id="imageUpload" name="photo" accept="image/*"
                                    style="display: none;" {{ !isset($user) ? "required" : "" }}>
                                <div id="imagePreview" class="image-preview">
                                    @if(isset($user) && $user->photo)
                                    <div class='d-flex flex-column'>
                                        <img src="{{ asset($user->photo) }}" alt="Image Preview" style="max-width: 100%; max-height: 200px;">
                                        <label for="imageUpload" id="uploadButton" class="button">Upload Profile Picture</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="multicol-username" class="form-control" placeholder="Name"
                                            name="name" value="{{ isset($user) ? $user->name : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Role</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="basic-default-country" name="role_id" required="">
                                            @foreach($roles as $role)
                                                <option {{ isset($user) && $role->id === $user->role_id ? "selected" : "" }} value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Age</label>
                                    <div class="col-sm-9">
                                        <input type="number" id="multicol-username" class="form-control" placeholder="Age"
                                            name="age" value="{{ isset($user) ? $user->age : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="multicol-username" class="form-control"
                                            placeholder="Phone" name="phone" value="{{ isset($user) ? $user->phone : '' }}"
                                            required>
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
                                <div class="col-md-6">
                                    <div class="col-sm-9 mt-3">
                                        <label class="switch switch-success">
                                            <input type="checkbox" class="switch-input" name="status" {{ isset($user) ? ($user->is_active === 1 ? "checked" :  "") : 'checked' }} />
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
                                        <div class="col-sm-9">
                                            <button type="submit"
                                                class="btn btn-primary me-sm-2 me-1 waves-effect waves-light"><i class='fa-solid fa-{{ isset($user) ? "cloud-arrow-up" : "save" }}'></i> &nbsp; {{ isset($user) ? 'Update' : 'Save' }}</button>
                                            <button class="btn btn-label-secondary waves-effect" type="button"><a
                                                    href="{{ route('users.list') }}">Cancel</a></button>
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
