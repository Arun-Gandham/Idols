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
@include('templates.pages.product_view.product_header')
<!-- Navbar pills -->
<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
            <li class="nav-item"><a class="nav-link active" href="#page_top"><i class='ti-xs ti ti-user-check me-1'></i> Details</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.orders.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-user-check me-1'></i> Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.teams.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-users me-1'></i> Teams</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.stock.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-layout-grid me-1'></i> Stocks</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.other.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-link me-1'></i> Other</a></li>
        </ul>
    </div>
</div>
<!--/ Navbar pills -->

<!-- User Profile Content -->
<div class="row">
    <div class="col-12">
        <!-- About User -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">About</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Full Name:</span> <span>John Doe</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-check text-heading"></i><span class="fw-medium mx-2 text-heading">Status:</span> <span>Active</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Role:</span> <span>Developer</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Country:</span> <span>USA</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-file-description text-heading"></i><span class="fw-medium mx-2 text-heading">Languages:</span> <span>English</span></li>
                </ul>
                <small class="card-text text-uppercase">Images</small>
                <div class="row mb-4 mt-3">
                    @if(isset($product->images) && count(unserialize($product->images)))
                    @foreach(unserialize($product->images) as $image)
                    <div class="col-md-3 mb-md-0 mb-2">
                        <div class="form-check custom-option custom-option-image custom-option-image-radio checked">
                            <span class="custom-option-body">
                                <img src="{{ asset($image) }}" alt="radioImg">
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ User Profile Content -->
@endsection