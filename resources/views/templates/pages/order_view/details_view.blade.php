@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "Product Details View")

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
@endsection

<!-- Page -->
@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection


@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/pages-profile.js') }}"></script>
@endsection

@section('content')
<style>
    .max-width-idol {
        max-width: 20rem;
        width: 100%;
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
<div class="card mb-4" id="page_top">
    <div class="card-body">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 mt-auto mb-auto text-center">
                <img src="{{ asset($order->product->thumbnail) }}" class="max-width-idol" alt="human image">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 mt-auto">
                <div class="row">
                    <div class="col-md-6">
                        <small class="card-text text-uppercase">Order Details</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">User Name:</span> <span>{{ $order->name }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Phone:</span> <span>{{ $order->phone1 }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Alt Phone:</span> <span>{{ $order->phone2 }}</span>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Address:</span> <span>{{ $order->address }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Price:</span> <span>{{ $order->phone2 }}</span>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Cover Price:</span> <span>{{ $order->address }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Crane Price:</span> <span>{{ $order->note }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Note:</span> <span>{{ $order->note }}</span></li>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase">Product Details</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Product Name:</span> <span>{{ $order->product->name }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Feet:</span> <span>{{ $order->product->feet_id }}</span></li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="status-update-bar mb-4">
    <div class="card">
        <div class="card-body">
            
            <form class="card-body" method="POST" action="{{ isset($product) ? route('product.edit.submit') : route('product.add.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                <small class="card-text text-uppercase">Update Status</small>
                    <div class="col-md-6">
                        <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Status</label>
                        <div class="col-sm-11">
                            <select class="form-select" name="feet_id" required="">
                                @foreach ($statuses as $status)
                                <option {{ isset($order) && $status->id === $order->status_id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Amount</label>
                        <div class="col-sm-11">
                            <input type="number" class="form-control" placeholder="Amount" name="amount" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="col-sm-12 col-form-label" for="multicol-username">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" placeholder="Say it" rows="3" required name="description"></textarea>
                        </div>
                    </div>
                    <div class="pt-4">
                        <div class="row justify-content-start">
                            <div class="col-sm-11">
                                <input type="hidden" name="id" value="{{$order->id}}">
                                <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- User Profile Content -->
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">Product Details</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Product Name:</span> <span>{{ $order->product->name }}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-check text-heading"></i><span class="fw-medium mx-2 text-heading">Body Color:</span> <span>{{ $order->product->body_color }}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Pancha/Saree Color:</span> <span>{{ $order->product->pancha_saree_color }}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Feet:</span> <span>{{ $order->product->feet_id }}</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
        <!-- Activity Timeline -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Activity Timeline</h5>
                <div class="card-action-element">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical text-muted"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                <ul class="timeline ms-1 mb-0">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Client Meeting</h6>
                                <small class="text-muted">Today</small>
                            </div>
                            <p class="mb-2">Project meeting with john @10:15am</p>
                            <div class="d-flex flex-wrap">
                                <div class="avatar me-2">
                                    <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div class="ms-1">
                                    <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                    <span>CEO of Infibeam</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Create a new project for client</h6>
                                <small class="text-muted">2 Day Ago</small>
                            </div>
                            <p class="mb-0">Add files to new design folder</p>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-danger"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Shared 2 New Project Files</h6>
                                <small class="text-muted">6 Day Ago</small>
                            </div>
                            <p class="mb-2">Sent by Mollie Dixon <img src="{{ asset('assets/img/avatars/4.png') }}" class="rounded-circle me-3" alt="avatar" height="24" width="24"></p>
                            <div class="d-flex flex-wrap gap-2 pt-1">
                                <a href="javascript:void(0)" class="me-3">
                                    <img src="{{ asset('assets/img/icons/misc/doc.png') }}" alt="Document image" width="15" class="me-2">
                                    <span class="fw-medium text-heading">App Guidelines</span>
                                </a>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/icons/misc/xls.png') }}" alt="Excel image" width="15" class="me-2">
                                    <span class="fw-medium text-heading">Testing Results</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent border-transparent">
                        <span class="timeline-point timeline-point-info"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Project status updated</h6>
                                <small class="text-muted">10 Day Ago</small>
                            </div>
                            <p class="mb-0">Woocommerce iOS App Completed</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ User Profile Content -->
@endsection