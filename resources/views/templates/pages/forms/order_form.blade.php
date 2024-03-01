@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : 'Product Form')
@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/animate-css/animate.css')}}">
@endsection

@section('page-script')
<script src="{{asset('assets/js/ui-modals.js')}}"></script>
@endsection
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

<style>
    #list li {
        text-decoration: none;
        list-style-type: none;
    }

    #list {
        padding-left: 0rem !important;
    }

    .product-details p {
        padding: 0;
        margin: 0;
    }

    .title {
        font-size: 18px;
        color: black;
        font-weight: 400;
    }

    .items-list {
        max-height: 30rem;
        /* min-height: 30rem; */
        overflow-y: auto;
        overflow-x: hidden;
    }

    .product-id {
        font-size: 13px
    }

    .image-outer {
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        border: 2px dashed #dbdade;
        border-radius: 0.5rem;
        margin: 0px auto;
        width: 100%;
    }

    .image-outer img {
        max-width: 15rem;
        max-height: 15rem;
    }

    /* WebKit Scrollbar */
    ::-webkit-scrollbar {
        width: 12px;
        /* Width of the scrollbar */
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Color of the scrollbar track */
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #DBDBDC;
        /* Color of the scrollbar handle */
        border-radius: 6px;
        /* Rounded corners */
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #DBDBDC;
        /* Color of the scrollbar handle on hover */
    }
</style>

<div class="row">
    <div class="col">
        <div class="card mb-4">
            <form class="card-body" method="POST" action="{{ isset($order) ? route('order.edit.submit') : route('order.add.submit') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="image-outer">
                            <div class="d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ isset($order) ? asset($order->product->thumbnail) : asset('default/avatar.png') }}" alt="test" class="w-100 m-2" id="selected_product_image">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                    Select Product
                                </button>
                                <div class="row mt-2">
                                    <p>Product Name : <span id="selected_product_name">{{ isset($order) ? $order->product->name : '---' }}</span></p>
                                    <p>Feet : <span id="selected_product_feet">{{ isset($order) ? $order->product->feet_id  : '---' }}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Name</label>
                                <div class="col-sm-11">
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ isset($order) ? $order->name : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Phone</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Phone" name="phone1" value="{{ isset($order) ? $order->phone1 : '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Alt Phone</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Alt Phone" name="phone2" value="{{ isset($order) ? $order->phone2 : '' }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Price</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Price" name="price" value="{{ isset($order) ? $order->price : '' }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Crane Price</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Crane Price" name="crane_price" value="{{ isset($order) ? $order->price : 0 }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Cover Price</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Cover Price" name="cover_price" value="{{ isset($order) ? $order->price : 0 }}" required>
                                </div>
                            </div>

                            @if(!isset($order))
                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Status</label>
                                <div class="col-sm-11">
                                    <select class="form-select" name="status" required="">
                                        @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Received Amount</label>
                                <div class="col-sm-11">
                                    <input type="number" class="form-control" placeholder="Received Amount" name="received_amount">
                                </div>
                            </div>
                            @endif

                            <div class="col-sm-12">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Address</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" placeholder="Say it" rows="3" required name="address">{{ isset($order) ? $order->address : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label class="col-sm-12 col-form-label" for="multicol-username">Note</label>
                                <div class="col-sm-12">
                                    <textarea class="form-control" placeholder="Say it" rows="3" name="note">{{ isset($order) ? $order->address : '' }}</textarea>
                                </div>
                            </div>
                            <div class="pt-4">
                                <div class="row justify-content-start">
                                    <div class="col-sm-11">
                                        <input type="hidden" name="product_id" value="{{ isset($order) ? $order->product->id : ''}}" id="selected_product_id" required>
                                        <input type="hidden" name="id" value="{{ isset($order) ? $order->id : ''}}">
                                        <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($order) ? 'Update' : 'Submit' }}</button>
                                        <button class="btn btn-label-secondary waves-effect" type="button"><a href="{{ route('order.list') }}">Cancel</a></button>
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


<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="search-input">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                </div>
                <div class="search-results">
                    <div id="list" class="d-flex flex-column items-list ">
                        @foreach ($products as $product)
                        <li class="card mt-2 cursor-pointer hoverd-item" onclick="getProductDetails('{{ $product->id }}','{{ asset($product->thumbnail) }}','{{$product->name}}','{{$product->feet_id}}')">
                            <div class="row">
                                <div class="col-sm-4">
                                    <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->name }}" class="w-100 m-2">
                                </div>
                                <div class="col-sm-8 product-details d-flex flex-column justify-content-center align-item-center">
                                    <p>#{{ $product->id }}</p>
                                    <p class="title">{{ $product->name }}</h1>
                                    <p class="desc">sfsfasdfa</p>
                                    <p class="desc">sfsfasdfa</p>
                                    <p class="desc">sfsfasdfa</p>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
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

    function getProductDetails(id, image, name, feet) {
        document.getElementById('selected_product_image').src = image;
        document.getElementById('selected_product_name').innerHTML = name;
        document.getElementById('selected_product_feet').innerHTML = feet;
        document.getElementById('selected_product_id').value = id;
        $('#basicModal').modal('hide')
    }
</script>
@endsection