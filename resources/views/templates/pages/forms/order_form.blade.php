@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : 'Product Form')

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
            min-height: 30rem;
            overflow: scroll;
        }

        .product-id {
            font-size: 13px
        }
    </style>

    <div class="row">
        <!-- Form Separator -->
        <div class="col">
            <div class="card mb-4">
                <form class="card-body" method="POST"
                    action="{{ isset($order) ? route('order.edit.submit') : route('order.add.submit') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card p-2">
                                <div class="search-input">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                                </div>
                                <div class="search-results">
                                    <div id="list" class="d-flex flex-column items-list ">
                                        @foreach ($products as $product)
                                            <li class="card mt-2 cursor-pointer hoverd-item"
                                                onclick="getProductDetails($product->id,$product->thumbnail,$product->name)">
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img src="{{ asset($product->thumbnail) }}"
                                                            alt="{{ $product->name }}" class="w-100 m-2">
                                                    </div>
                                                    <div class="col-sm-8 product-details">
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
                        </div>
                        <div class="col-md-12">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Name</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Name" name="name"
                                            value="{{ isset($order) ? $order->name : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Status</label>
                                    <div class="col-sm-11">
                                        <select class="form-select" name="type_id" required="">
                                            @foreach ($statuses as $status)
                                                <option data-image="http://127.0.0.1:8001/uploads/products/1/1709136479.png"
                                                    data-description="sgsdfgsd"
                                                    {{ isset($product) && $status->id === $product->type_id ? 'selected' : '' }}
                                                    value="{{ $status->id }}">
                                                    <img src="http://127.0.0.1:8001/uploads/products/1/1709136479.png">
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-sm-3 col-md-12 col-form-label" for="multicol-username">Status</label>
                                    <div class="col-sm-11">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                Select Status
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @foreach ($statuses as $status)
                                                    <a class="dropdown-item" href="#"
                                                        onclick="setStatus('{{ $status->id }}', '{{ $status->name }}')">
                                                        <img src="{{ $status->image_url }}" alt="{{ $status->name }}"
                                                            class="img-fluid"
                                                            style="width: 30px; height: 30px; margin-right: 10px;">
                                                        {{ $status->name }} - {{ $status->description }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                        <input type="hidden" id="status_id" name="status_id" value="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Status</label>
                                    <div class="col-sm-11">
                                        <select class="form-select" name="type_id" required="">
                                            @foreach ($statuses as $status)
                                                <option
                                                    {{ isset($product) && $status->id === $product->type_id ? 'selected' : '' }}
                                                    value="{{ $status->id }}">{{ $status->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Price</label>
                                    <div class="col-sm-11">
                                        <input type="number" class="form-control" placeholder="Price" name="price"
                                            value="{{ isset($product) ? $product->price : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Body
                                        Color</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Body Color"
                                            name="body_color" value="{{ isset($product) ? $product->body_color : '' }}"
                                            required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-sm-12 col-form-label" for="multicol-username">Pancha/Saree
                                        Color</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control" placeholder="Pancha/Saree Color"
                                            name="pancha_saree_color"
                                            value="{{ isset($product) ? $product->pancha_saree_color : '' }}" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label class="col-sm-12 col-form-label" for="multicol-username">Stock</label>
                                    <div class="col-sm-11">
                                        <input type="number" class="form-control" placeholder="Stock" name="stock"
                                            value="{{ isset($product) ? $product->stock : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-sm-12 col-form-label" for="multicol-username">Images</label>
                                    <div class="col-sm-11">
                                        <input type="file" multiple="multiple" accept="image/*" class="form-control"
                                            name="images[]">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-sm-12 col-form-label" for="multicol-username">Description</label>
                                    <div class="col-sm-11">
                                        <textarea class="form-control" placeholder="Say it" rows="3" required name="description">{{ isset($product) ? $product->description : '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="col-sm-9 mt-3">
                                        <label class="switch switch-success">
                                            <input type="checkbox" class="switch-input" name="status"
                                                {{ isset($product) ? ($product->status === 1 ? 'checked' : '') : 'checked' }} />
                                            <span class="switch-toggle-slider">
                                                <span class="switch-on">
                                                    <i class="ti ti-check"></i>
                                                </span>
                                                <span class="switch-off">
                                                    <i class="ti ti-x"></i>
                                                </span>
                                            </span>
                                            <span class="switch-label">Status</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="pt-4">
                                    <div class="row justify-content-start">
                                        <div class="col-sm-11">
                                            <input type="hidden" name="id"
                                                value="{{ isset($product) ? $product->id : null }}">
                                            <button type="submit"
                                                class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">{{ isset($product) ? 'Update' : 'Submit' }}</button>
                                            <button class="btn btn-label-secondary waves-effect" type="button"><a
                                                    href="{{ route('product.list') }}">Cancel</a></button>
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

    <script>
        function setStatus(id, name) {
            document.getElementById('status_id').value = id;
            document.getElementById('dropdownMenuButton').innerText = name;
        }

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
@endsection
