@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "Products List")

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
@endsection

@section('page-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
<!-- Include DataTables library -->

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endsection

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
<!-- 
<div data-bs-spy="scroll" class="scrollspy-example">
    <div class="mb-5">
        <div class="card">
            <div class="card-body py-3">
                <div class="row">
                    <div class="col-md-3 col-sm-12">
                        <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
                            <option value="" selected>All</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    <div class="col-md-3 col-sm-12">
                        <select id="multicol-country" class="select2 form-select" data-allow-clear="true">
                            <option value="" selected>All</option>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-5 col-sm-0"></div>
                    <div class="col-md-1 col-sm-12">
                        <button type="button" class="btn btn-primary waves-effect waves-light w-100">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section id="idols" class="landing-team">
        <div class="container">
            <div class="row gy-5 mt-2">
                @php
                $classes = ['primary', 'info', 'success', 'danger'];
                @endphp
                @foreach ($products as $key => $product)
                <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                    <a href="{{ route('product.details.view', ['id' => $product->id]) }}" class="">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-{{ $classes[$key % count($classes)] }} position-relative team-image-box">
                                <img src="{{ asset($product->thumbnail) }}" class="hover-change position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-{{ $classes[$key % count($classes)] }} text-center">

                                <h5 class="card-title mb-0">{{ $product->name }}</h5>
                                <p class="text-muted mb-0">6 Feet</p>
                                <p class="text-muted mb-0">Pancha: {{ $product->pancha_saree_color }}</p>
                                <p class="text-muted mb-0">Body: {{ $product->body_color }}</p>
                                <p class="text-muted mb-0 text-success">Status:
                                    {{ $product->status === 1 ? 'Active' : 'Inactive' }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @if(!count($products))
                <div class="col-12 d-flex justify-content-center outer align-items-center">
                    <h1>No {{ isset($pageSettings['type']) ? $pageSettings['type'] : "" }} Data Available</h1>
                </div>
                @endif
            </div>
        </div>
    </section>
</div> -->
<style>
    #dataTable_wrapper {
        padding: 20px;
        /* Add padding around the DataTable */
    }

    #dataTable_filter label {
        margin-bottom: 10px;
        /* Add margin below the search input */
    }

    #dataTable_paginate {
        margin-top: 10px;
        /* Add margin above the pagination buttons */
    }

    /* Styling for responsive table */
    .table-responsive {
        overflow-x: auto;
        /* Enable horizontal scrolling for small screens */
    }

    .table {
        width: 100%;
        /* Ensure the table fills its container */
        border-collapse: collapse;
        /* Collapse borders between table cells */
    }

    .table th,
    .table td {
        padding: 10px;
        /* Add padding to table cells */
        text-align: left;
        /* Align text to the left */
        border: 1px solid #dee2e6;
        /* Add borders to table cells */

    }

    .table th {
        /* background-color: #7376f0; */
        font-weight: bold;
        /* Make table headers bold */
    }

    .table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
        /* Alternate background color for table rows */
    }

    table#dataTable {
        width: 100% !important;
    }
</style>
<div class="card">
    <div class="table-responsive text-nowrap p-3 table-outer">
        <table id="dataTable" class="table">
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            columnDefs: [{
                "orderable": false,
                targets: [0, 1, 2, 3]
            }],
            ajax: "{{ route('order.list.datatables') }}",
            columns: [{
                    data: 'order_id',
                    name: 'order_id',
                    render: function(data, type, row) {
                        return '<a href="/orders/' + row.id + '">' + data + '</a>';
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'product_name',
                    name: 'product_name',
                    render: function(data, type, row) {
                        return '<a href="/product/' + row.product_id + '/details">' + data + '</a>';
                    }
                },
                {
                    data: 'actions',
                    name: 'actions'
                }
            ],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ]
        });
    });
</script>
@endsection