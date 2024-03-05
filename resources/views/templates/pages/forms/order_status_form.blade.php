@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : 'Role Form')

@section('content')
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
                    action="{{ isset($status) ? route('order.status.edit.submit') : route('order.status.add.submit') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label" for="multicol-username">Name</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            value="{{ isset($status) ? $status->name : '' }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="row justify-content-start">
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="{{ isset($status) ? $status->id : '' }}">
                                    <button type="submit"
                                        class="btn btn-primary me-sm-2 me-1 waves-effect waves-light"><i class='fa-solid fa-{{ isset($status) ? "cloud-arrow-up" : "save" }}'></i> &nbsp; {{ isset($status) ? 'Update' : 'Save' }}</button>
                                    <button class="btn btn-label-secondary waves-effect"><a
                                            href="{{ route('order.status.list') }}">Cancel</a></button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
