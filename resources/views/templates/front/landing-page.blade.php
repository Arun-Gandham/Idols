@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "Home Page")

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
<div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Hero: Start -->
    <section id="hero-animation">
        <div id="landingHero" class="section-py landing-hero ">
            <div class="container row  align-items-center">
                <div id="" class=" col-md-6">
                    <a href="#idols">
                        <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                            <img src="{{ asset('assets/img/front-pages/landing-page/lord-ganesh-front.png') }}" alt="hero dashboard" class="animation-img w-100" data-app-light-img="front-pages/landing-page/lord-ganesh-front.png" data-app-dark-img="front-pages/landing-page/lord-ganesh-front.png" />
                            {{-- <img src="{{ asset('assets/img/front-pages/landing-page/hero-elements-' . $configData['style'] . '.png') }}"
                            alt="hero elements"
                            class="position-absolute hero-elements-img animation-img top-0 start-0"
                            data-app-light-img="front-pages/landing-page/hero-elements-light.png"
                            data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" /> --}}
                        </div>
                    </a>
                </div>
                <div class="col-md-6">
                    <h1 class="text-primary hero-title display-6 fw-bold">{{ isset($settings->name) ? $settings->name : '' }}</h1>
                    <h2 class="hero-sub-title h6 mb-4 pb-1">{{ isset($settings->description) ? $settings->description : '' }}</h2>
                    <div class="landing-hero-btn d-inline-block position-relative">
                        <a href="#idols" class="btn btn-primary btn-lg">Show Idols</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="landing-hero-blank"></div> --}}
    </section>
    <!-- Hero: End -->

    <!-- Our great team: Start -->
    <section id="idols" class="section-py landing-team">
        @php
        $classes = ['primary', 'info', 'success', 'danger'];
        @endphp
        @foreach($productTypes as $type)
        @if(count($type->productList))
        <div class="container mb-4">
            <h3 class="text-center mb-1"><span class="section-title">{{ $type->name }}</span> Idols</h3>
            <p class="text-center mb-md-5 pb-3">{{ $type->description }}</p>
            <div class="row gy-5 mt-2">
                @foreach($type->productList as $key => $product)
                <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                    <a href="" class="">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-{{ $classes[$key % count($classes)] }} position-relative team-image-box">
                                <img src="{{ asset($product->thumbnail) }}" class="hover-change position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl" alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-{{ $classes[$key % count($classes)] }} text-center">
                                <h5 class="card-title mb-0">{{ $product->name }}</h5>
                                <p class="text-muted mb-0">{{ $product->feet->feet }} Feet</p>
                                <p class="text-muted mb-0">Pancha/Saree: {{ $product->pancha_saree_color }}</p>
                                <p class="text-muted mb-0">Body Color: {{ $product->body_color }}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </section>
    <!-- Our great team: End -->

    <!-- Real customers reviews: Start -->
    <section id="landingReviews" class="section-py bg-body landing-reviews pb-0">
        <!-- What people say slider: Start -->
        <div class="container">
            <div class="row align-items-center gx-0 gy-4 g-lg-5">
                <div class="col-md-6 col-lg-5 col-xl-3">
                    <div class="mb-3 pb-1">
                        <span class="badge bg-label-primary">Real Customers Reviews</span>
                    </div>
                    <h3 class="mb-1"><span class="section-title">What people say</span></h3>
                    <p class="mb-3 mb-md-3">
                        See what our customers have to<br class="d-none d-xl-block" />
                        say about their experience.
                    </p>
                    <div class="landing-reviews-btns">
                        <button id="reviews-previous-btn" class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl" type="button">
                            <i class="ti ti-chevron-left ti-sm"></i>
                        </button>
                        <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl" type="button">
                            <i class="ti ti-chevron-right ti-sm"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-9">
                    <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                        <div class="swiper" id="swiper-reviews">
                            <div class="swiper-wrapper">
                                @foreach ($testimonials as $key => $testimonial)
                                <div class="swiper-slide">
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
                                        </div>
                                    </div>

                                </div>
                                @endforeach

                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Logo slider: End -->
    </section>
    <!-- Real customers reviews: End -->

    <!-- CTA: Start -->
    <section id="landingCTA" class="section-py landing-cta p-lg-0 pb-0">
        <div class="container">
            <div class="row align-items-center gy-5 gy-lg-0">
                <div class="col-lg-6 text-center text-lg-start">
                    <h6 class="h2 text-primary fw-bold mb-1">Get your Idol now</h6>
                    <p class="fw-medium mb-4">Checkout our new collections</p>
                    <a href="#idols" class="btn btn-lg btn-primary">Show Idols</a>
                </div>
                <div class="col-lg-6 text-center text-lg-end">
                    <img src="{{ asset('assets/img/website/front-page/ganesh.png') }}" alt="cta dashboard" class="img-fluid" />
                </div>
            </div>
        </div>
    </section>
    <!-- CTA: End -->

    <!-- Contact Us: Start -->
    <section id="landingContact" class="section-py bg-body landing-contact">
        <div class="container">
            <h3 class="text-center mb-1"><span class="section-title">Contact Us</span></h3>
            <p class="text-center mb-4 mb-lg-5 pb-md-3">Any question or remark? just write us a message</p>
            <div class="row gy-4">
                <div class="col-lg-5">
                    <div class="contact-img-box position-relative border p-2 h-100">
                        <img src="{{ asset('assets/img/front-pages/landing-page/contact-customer-service.png') }}" alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                        <div class="pt-3 px-4 pb-1">
                            <div class="row gy-3 gx-md-4">
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-primary rounded p-2 me-2"><i class="ti ti-mail ti-sm"></i></div>
                                        <div>
                                            <p class="mb-0">Email</p>
                                            <h5 class="mb-0">
                                                <a href="{{ isset($settings->email) ? $settings->email : '' }}" class="text-heading">{{ isset($settings->email) ? $settings->email : '' }}</a>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6">
                                    <div class="d-flex align-items-center">
                                        <div class="badge bg-label-success rounded p-2 me-2">
                                            <i class="ti ti-phone-call ti-sm"></i>
                                        </div>
                                        <div>
                                            <p class="mb-0">Phone</p>
                                            <h5 class="mb-0"><a href="tel:{{ isset($settings->phone) ? $settings->phone : '' }}" class="text-heading">+91 {{ isset($settings->phone) ? $settings->phone : '' }}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-1">Send a message</h4>
                            <p class="mb-4">
                                If you would like to discuss anything related to payment, account, licensing,<br class="d-none d-lg-block" />
                                partnerships, or have pre-sales questions, you’re at the right place.
                            </p>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="contact-form-fullname">Full Name</label>
                                        <input type="text" class="form-control" id="contact-form-fullname" placeholder="john" />
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="contact-form-email">Email</label>
                                        <input type="text" id="contact-form-email" class="form-control" placeholder="johndoe@gmail.com" />
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="contact-form-message">Message</label>
                                        <textarea id="contact-form-message" class="form-control" rows="8" placeholder="Write a message"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Send inquiry</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Us: End -->
</div>
@endsection