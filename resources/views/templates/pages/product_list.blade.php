@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Front Pages')

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
        <section id="idols" class="landing-team">
            <div class="container">
                <div class="row gy-5 mt-2">
                    @php
                        $classes = ['primary', 'info', 'success', 'danger'];
                    @endphp
                    @foreach ($products as $key => $product)
                        <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                            <a href="" class="">
                                <div class="card mt-3 mt-lg-0 shadow-none">
                                    <div
                                        class="bg-label-{{ $classes[$key % count($classes)] }} position-relative team-image-box">
                                        <img src="{{ asset($product->thumbnail) }}"
                                            class="hover-change position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                            alt="human image" />
                                    </div>
                                    <div
                                        class="card-body border border-top-0 border-label-{{ $classes[$key % count($classes)] }} text-center">

                                        <h5 class="card-title mb-0">{{ $product->name }}</h5>
                                        <p class="text-muted mb-0">6 Feet</p>
                                        <p class="text-muted mb-0">Pancha: {{ $product->pancha_saree_color }}</p>
                                        <p class="text-muted mb-0">Body: {{ $product->body_color }}</p>
                                        <p class="text-muted mb-0">Support: pillow</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    {{-- <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="" class="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-primary position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord1.png') }}"
                                        class="hover-change position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-primary text-center">
                                    <h5 class="card-title mb-0">Royal Ganesh</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-info position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord2.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-info text-center">
                                    <h5 class="card-title mb-0">White Pancha Ganesh</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-danger position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord3.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-danger text-center">
                                    <h5 class="card-title mb-0">Purple Ganesh</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-primary position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord4.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-primary text-center">
                                    <h5 class="card-title mb-0">Sophie Gilbert</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-info position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord5.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-info text-center">
                                    <h5 class="card-title mb-0">Royal Sitting Ganesh</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-danger position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord6.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-danger text-center">
                                    <h5 class="card-title mb-0">North Ganesh</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-primary position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord3.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-primary text-center">
                                    <h5 class="card-title mb-0">Sophie Gilbert</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-info position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord2.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-info text-center">
                                    <h5 class="card-title mb-0">Paul Miles</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-danger position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord1.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-danger text-center">
                                    <h5 class="card-title mb-0">Nannie Ford</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-danger position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord6.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-danger text-center">
                                    <h5 class="card-title mb-0">North Ganesh</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-primary position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord3.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-primary text-center">
                                    <h5 class="card-title mb-0">Sophie Gilbert</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <a href="">
                            <div class="card mt-3 mt-lg-0 shadow-none">
                                <div class="bg-label-info position-relative team-image-box">
                                    <img src="{{ asset('assets/img/idols/lord2.png') }}"
                                        class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                        alt="human image" />
                                </div>
                                <div class="card-body border border-top-0 border-label-info text-center">
                                    <h5 class="card-title mb-0">Paul Miles</h5>
                                    <p class="text-muted mb-0">6 Feet</p>
                                    <p class="text-muted mb-0">Pancha: orange</p>
                                    <p class="text-muted mb-0">Vahanam: Nemali</p>
                                    <p class="text-muted mb-0">Support: pillow</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-primary position-relative team-image-box">
                                <img src="{{ asset('assets/img/idols/ammavaru1.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-primary text-center">
                                <h5 class="card-title mb-0">Green Saree Ammavaru</h5>
                                <p class="text-muted mb-0">6 Feet</p>
                                <p class="text-muted mb-0">Saree: Green</p>
                                <p class="text-muted mb-0">Skin: White</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-info position-relative team-image-box">
                                <img src="{{ asset('assets/img/idols/ammavaru2.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-info text-center">
                                <h5 class="card-title mb-0">Paul Miles</h5>
                                <p class="text-muted mb-0">6 Feet</p>
                                <p class="text-muted mb-0">Saree: Green</p>
                                <p class="text-muted mb-0">Skin: White</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-danger position-relative team-image-box">
                                <img src="{{ asset('assets/img/idols/ammavaru3.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-danger text-center">
                                <h5 class="card-title mb-0">Nannie Ford</h5>
                                <p class="text-muted mb-0">6 Feet</p>
                                <p class="text-muted mb-0">Saree: Green</p>
                                <p class="text-muted mb-0">Skin: White</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-primary position-relative team-image-box">
                                <img src="{{ asset('assets/img/idols/ammavaru4.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-primary text-center">
                                <h5 class="card-title mb-0">Sophie Gilbert</h5>
                                <p class="text-muted mb-0">6 Feet</p>
                                <p class="text-muted mb-0">Saree: Green</p>
                                <p class="text-muted mb-0">Skin: White</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-info position-relative team-image-box">
                                <img src="{{ asset('assets/img/idols/ammavaru1.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-info text-center">
                                <h5 class="card-title mb-0">Paul Miles</h5>
                                <p class="text-muted mb-0">6 Feet</p>
                                <p class="text-muted mb-0">Saree: Green</p>
                                <p class="text-muted mb-0">Skin: White</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-sm-6 mt-5 mb-4">
                        <div class="card mt-3 mt-lg-0 shadow-none">
                            <div class="bg-label-danger position-relative team-image-box">
                                <img src="{{ asset('assets/img/idols/ammavaru2.png') }}"
                                    class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                                    alt="human image" />
                            </div>
                            <div class="card-body border border-top-0 border-label-danger text-center">
                                <h5 class="card-title mb-0">Nannie Ford</h5>
                                <p class="text-muted mb-0">6 Feet</p>
                                <p class="text-muted mb-0">Saree: Green</p>
                                <p class="text-muted mb-0">Skin: White</p>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
    </div>
@endsection
