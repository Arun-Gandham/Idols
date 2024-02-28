@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "User Profile")

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
<!-- Header -->
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="user-profile-header-banner">
                <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
            </div>
            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                    <img src="{{ asset($user->photo) }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                </div>
                <div class="flex-grow-1 mt-3 mt-sm-5">
                    <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                        <div class="user-profile-info">
                            <h4>{{ $user->name }}</h4>
                            <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                <li class="list-inline-item d-flex gap-1">
                                    <i class='ti ti-color-swatch'></i> {{ $user->phone }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class='ti ti-map-pin'></i> {{ $user->email }}
                                </li>
                                <li class="list-inline-item d-flex gap-1">
                                    <i class='ti ti-calendar'></i> Joined {{ date("F Y", strtotime($user->created_at)) }}
                                </li>
                            </ul>
                        </div>
                        <a href="{{ route('users.edit',['id'=>$user->id])}}" class="btn btn-primary">
                            <i class='ti ti-check me-1'></i>Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Header -->
<!-- User Profile Content -->
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">About</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Full Name:</span> <span>{{ $user->name }}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-check text-heading"></i><span class="fw-medium mx-2 text-heading">Status:</span> <span>{{ $user->is_active === 1 ? "Active" : "Inactive"}}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Age:</span> <span>{{ $user->age }}</span></li>

                </ul>
                <small class="card-text text-uppercase">Contacts</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Contact:</span> <span>{{ $user->phone }}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-mail"></i><span class="fw-medium mx-2 text-heading">Email:</span> <span>{{ $user->email }}</span></li>
                </ul>
            </div>
        </div>
        <!--/ About User -->
        <!-- Profile Overview -->
        <div class="card mb-4">
            <div class="card-body">
                <p class="card-text text-uppercase">Overview</p>
                <ul class="list-unstyled mb-0">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span class="fw-medium mx-2">Task Compiled:</span> <span>13.5k</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-layout-grid"></i><span class="fw-medium mx-2">Projects Compiled:</span> <span>146</span></li>
                    <li class="d-flex align-items-center"><i class="ti ti-users"></i><span class="fw-medium mx-2">Connections:</span> <span>897</span></li>
                </ul>
            </div>
        </div>
        <!--/ Profile Overview -->
    </div>

    <div class="col-xl-8 col-lg-7 col-md-7">
        <div class="mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Statistics</h5>
                    <small class="text-muted">Updated 1 month ago</small>
                </div>
                <div class="card-body pt-2">
                    <div class="row gy-3">
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="ti ti-chart-pie-2 ti-sm"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">230k</h5>
                                    <small>Sales</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="ti ti-users ti-sm"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">8.549k</h5>
                                    <small>Customers</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-2"><i class="ti ti-shopping-cart ti-sm"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">1.423k</h5>
                                    <small>Products</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="ti ti-currency-dollar ti-sm"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">$9745</h5>
                                    <small>Revenue</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Activity Timeline -->
        <div class="card card-action mb-4">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0">Activity Timeline</h5>
                <div class="card-action-element">
                    <div class="dropdown">
                        <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical text-muted"></i></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body pb-0">
                <ul class="timeline ms-1 mb-0">
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-primary"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Client Meeting</h6>
                                <small class="text-muted">Today</small>
                            </div>
                            <p class="mb-2">Project meeting with john @10:15am</p>
                            <div class="d-flex flex-wrap">
                                <div class="avatar me-2">
                                    <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div class="ms-1">
                                    <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                    <span>CEO of Infibeam</span>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Create a new project for client</h6>
                                <small class="text-muted">2 Day Ago</small>
                            </div>
                            <p class="mb-0">Add files to new design folder</p>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-danger"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Shared 2 New Project Files</h6>
                                <small class="text-muted">6 Day Ago</small>
                            </div>
                            <p class="mb-2">Sent by Mollie Dixon <img src="{{ asset('assets/img/avatars/4.png') }}" class="rounded-circle me-3" alt="avatar" height="24" width="24"></p>
                            <div class="d-flex flex-wrap gap-2 pt-1">
                                <a href="javascript:void(0)" class="me-3">
                                    <img src="{{ asset('assets/img/icons/misc/doc.png') }}" alt="Document image" width="15" class="me-2">
                                    <span class="fw-medium text-heading">App Guidelines</span>
                                </a>
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/img/icons/misc/xls.png') }}" alt="Excel image" width="15" class="me-2">
                                    <span class="fw-medium text-heading">Testing Results</span>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-item timeline-item-transparent border-transparent">
                        <span class="timeline-point timeline-point-info"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Project status updated</h6>
                                <small class="text-muted">10 Day Ago</small>
                            </div>
                            <p class="mb-0">Woocommerce iOS App Completed</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <!--/ Activity Timeline -->
    </div>
</div>
<!--/ User Profile Content -->
@endsection