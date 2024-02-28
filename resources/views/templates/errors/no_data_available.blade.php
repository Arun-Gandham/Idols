@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "Page")

@section('content')
<style>
    .outer {
        border: 2px dashed #dbdade;
        border-radius: 10px;
        height: 15rem;
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
<div class="row m-4">
    <div class="col-12 d-flex justify-content-center outer align-items-center">
        <h1>No {{ isset($pageSettings['type']) ? $pageSettings['type'] : "" }} Data Available</h1>
    </div>
</div>
@endsection