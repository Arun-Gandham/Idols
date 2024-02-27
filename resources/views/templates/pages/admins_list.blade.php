@extends('layouts/layoutMaster')

@section('title', 'DataTables - Tables')

@section('content')
<style>
    .rounded-circle {
        border-radius: 5% !important;
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

<div class="d-flex justify-content-between">
    <h4 class="py-3 mb-3">
        <span class="text-muted fw-light">Users /</span> List
    </h4>
    <a href="{{ route('users.add') }}"><button class="btn btn-primary mt-2" style="padding: 15px;height: 30px;"><i class="fa-solid fa-plus"></i>
            Add</button></a>
</div>
<div class="row g-4">
    @foreach($users as $user)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body text-center">
                <div class="dropdown btn-pinned">
                    <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical text-muted"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('users.edit',['id'=>$user->id])}}">Edit</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a></li>
                    </ul>
                </div>
                <div class="mx-auto my-3">
                    <img src="{{ asset($user->photo) }}" alt="Avatar Image" class="rounded-circle w-px-100" />
                </div>
                <a href="{{ route('user.profile.view',['id' => $user->id]) }}">
                    <h4 class="mb-1 card-title">{{ $user->name }}</h4>
                </a>
                <p class="m-0">Age : {{ $user->age }}</p>
                <p class="m-0">Phone : {{ $user->phone }}</p>
                <p class="m-0">Status : {{ $user->is_active ? "Active" : "Inactive" }}</p>
                <div class="d-flex align-items-center justify-content-around my-3 py-1">
                    <div>
                        <h4 class="mb-0">18</h4>
                        <span>Sold</span>
                    </div>
                    <div>
                        <h4 class="mb-0">834</h4>
                        <span>Amount Collected</span>
                    </div>
                    <div>
                        <h4 class="mb-0">129</h4>
                        <span>Connections</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection