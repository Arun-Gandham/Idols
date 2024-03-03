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
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
@endsection

@section('page-script')
<script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
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
<div data-bs-spy="scroll" class="scrollspy-example">
    <div class="container">
        <div class="row gy-5 mt-2">
            @foreach ($testimonials as $key => $testimonial)
            <div class="col-sm-12 col-md-4 p-2">
                <div class="card h-100">
                    <div class="card-body text-body d-flex flex-column justify-content-between h-100">
                        <p>
                            “{{ $testimonial->comment }}”
                        </p>
                        <div class="text-warning mb-3">
                            @for($i = 0;$i < $testimonial->star;$i++)
                                <i class="ti ti-star-filled ti-sm"></i>
                            @endfor
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="avatar me-2 avatar-sm">
                                <img src="http://127.0.0.1:8000/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $testimonial->name }}</h6>
                                <p class="small text-muted mb-0">Customer</p>
                            </div>
                        </div>
                        <div class="pt-4">
                            <div class="row justify-content-start">
                                <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light"><a class=" text-white" href="{{ route('testimonials.edit',$testimonial->id) }}">Edit</a></button>
                                    <button class="btn btn-danger waves-effect"><a class=" text-white" href="{{ route('testimonials.delete',$testimonial->id) }}">Delete</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
            @if(!count($testimonials))
            <div class="col-12 d-flex justify-content-center outer align-items-center">
                <h1>No Testimonials Available</h1>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection