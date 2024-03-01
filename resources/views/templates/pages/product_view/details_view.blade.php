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
                <img src="{{ asset($product->thumbnail) }}" class="max-width-idol" alt="human image">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 mt-auto">
                <div class="row">
                    <div class="col-md-6">
                        <small class="card-text text-uppercase">About</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Full Name:</span> <span>{{ $product->name }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Body Color:</span> <span>{{ $product->body_color }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Pancha/Saree Color:</span> <span>{{ $product->pancha_saree_color }}</span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase">Stock</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Total Stock:</span> <span>{{ $product->stock }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Available:</span> <span>33</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-brand-skype"></i><span class="fw-medium mx-2 text-heading">sold:</span> <span>15</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-brand-skype"></i><span class="fw-medium mx-2 text-heading">Yet to deliver:</span> <span>15</span></li>
                        </ul>
                    </div>

                </div>
                @if($product->is_deleted === 1)
                <a href="{{ route('product.restore',['id' => $product->id ]) }}" class="btn btn-success">
                    <i class="fa-solid fa-rotate me-1"></i> Restore
                </a>
                @else
                <a href="{{ route('product.edit',['id' => $product->id ]) }}" class="btn btn-success">
                    <i class='ti ti-pencil me-1'></i> Edit
                </a>
                <a href="{{ route('product.delete',['id' => $product->id ]) }}" class="btn btn-danger">
                    <i class='fa-solid fa-trash me-1'></i> Delete
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

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
                <small class="card-text text-uppercase">Contacts</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Contact:</span> <span>(123) 456-7890</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-brand-skype"></i><span class="fw-medium mx-2 text-heading">Skype:</span> <span>john.doe</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span> <span>john.doe@example.com</span></li>
                </ul>
                <small class="card-text text-uppercase">Teams</small>
                <ul class="list-unstyled mb-0 mt-3">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-brand-angular text-danger me-2"></i>
                        <div class="d-flex flex-wrap"><span class="fw-medium me-2 text-heading">Backend
                                Developer</span><span>(126 Members)</span></div>
                    </li>
                    <li class="d-flex align-items-center"><i class="ti ti-brand-react-native text-info me-2"></i>
                        <div class="d-flex flex-wrap"><span class="fw-medium me-2 text-heading">React
                                Developer</span><span>(98 Members)</span></div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--/ User Profile Content -->
@endsection