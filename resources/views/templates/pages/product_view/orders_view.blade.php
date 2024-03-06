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
                                        <p class="mb-1">Order Id : <strong><a href="{{ route('orders.view',$order->id) }}">{{ $order->order_id }}</a></strong></p>
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
                                        <img src="{{ asset(isset($order->createdBy->photo) ? $order->createdBy->photo : 'assets/img/website/default/profile.png') }}" class="border rounded me-3" alt="Shoe img" height="62" width="62">
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