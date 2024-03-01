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
            <li class="nav-item"><a class="nav-link" href="{{ route('product.details.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-user-check me-1'></i> Details</a></li>
            <li class="nav-item"><a class="nav-link active" href="#page_top"><i class='ti-xs ti ti-user-check me-1'></i> Orders</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.teams.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-users me-1'></i> Teams</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.stock.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-layout-grid me-1'></i> Stocks</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.other.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-link me-1'></i> Other</a></li>
        </ul>
    </div>
</div>
<!--/ Navbar pills -->

<!-- User Profile Content -->

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="container">
                <div class="search-input mt-5">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search Order">
                </div>
                <div class="card-body pb-0">
                    <ul class="timeline pt-3" id="list">
                        @foreach($product->orders as $order)
                        <li class="timeline-item pb-4 timeline-item-success border-left-dashed">
                            <span class="timeline-indicator-advanced timeline-indicator-success">
                                <i class="ti ti-basket rounded-circle"></i>
                            </span>
                            <div class="timeline-event pb-3">
                                <div class="d-flex flex-sm-row flex-column">

                                    <div class="w-100">
                                        <p class="mb-1">Order Id : <strong><a href="{{ route('order.view',$order->id) }}">{{ $order->order_id }}</a></strong></p>
                                        <div class="timeline-header flex-wrap mb-2 mt-3 mt-sm-0">
                                            <h6 class="mb-0">Customer Name : {{ $order->name }}</h6>
                                            <span class="text-muted">
                                                @php
                                                $dateTime = new DateTime($order->created_at);
                                                $today = new DateTime('today');
                                                $yesterday = new DateTime('yesterday');

                                                if ($dateTime->format('Y-m-d') === $today->format('Y-m-d')) {
                                                echo 'Today ' . $dateTime->format('g:i A');
                                                } elseif ($dateTime->format('Y-m-d') === $yesterday->format('Y-m-d')) {
                                                echo 'Yesterday ' . $dateTime->format('g:i A');
                                                } else {
                                                echo $dateTime->format('d F Y g:i A'); // Format as '23 April 2023'
                                                }
                                                @endphp
                                            </span>
                                        </div>
                                        <p class="mb-1">Phone : {{ $order->phone1 }}, {{ $order->phone2 }}</p>
                                        <p class="mb-1">Status : {{ isset($order->orderStatus) ? $order->orderStatus->name : "---"}}</p>
                                        <p class="mb-0">Address: {{ $order->address }}</p>
                                        <p class="mb-0">Note: {{ $order->note }}</p>
                                    </div>
                                </div>
                                <div class="divider">
                                    <div class="divider-text">
                                        Agent Details
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between flex-wrap flex-sm-row flex-column text-center">
                                    <div class="mb-sm-0 mb-2 d-flex align-items-center">
                                        <img src="{{ asset($order->createdBy->photo) }}" class="border rounded me-3" alt="Shoe img" height="62" width="62">
                                        <div>
                                            <p class="mb-0">Agent</p>
                                            <span class="text-muted"><a href="{{ route('user.profile.view',$order->created_by) }}">{{ $order->createdBy->name }}</a></span>
                                        </div>
                                    </div>
                                    <div class="mb-sm-0 mb-2">
                                        <p class="mb-0">Price</p>
                                        <span class="text-muted"><strong>&#8377;</strong> {{ $order->price }}</span>
                                    </div>
                                    <div>
                                        <p class="mb-0">Received</p>
                                        <span class="text-muted"><strong>&#8377;</strong> {{ $order->getOrderTotalReceived() }}</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('searchInput').addEventListener('input', function() {
        var searchQuery = this.value.toLowerCase();
        var listItems = document.querySelectorAll('#list li');

        listItems.forEach(function(item) {
            var text = item.textContent.toLowerCase();
            var altText = item.querySelector('img').getAttribute('alt').toLowerCase();
            if (text.includes(searchQuery) || altText.includes(searchQuery)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
<!--/ User Profile Content -->
@endsection