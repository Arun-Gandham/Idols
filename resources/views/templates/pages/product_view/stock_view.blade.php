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
        max-width: 30rem;
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
            <div class="col-xl-6 col-lg-6 col-md-6 mt-auto mb-auto">
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
            <li class="nav-item"><a class="nav-link" href="{{ route('product.teams.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-users me-1'></i> Teams</a></li>
            <li class="nav-item"><a class="nav-link active" href="#page_top"><i class='ti-xs ti ti-layout-grid me-1'></i> Stocks</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('product.other.view',['id' => $product->id ]) }}"><i class='ti-xs ti ti-link me-1'></i> Other</a></li>
        </ul>
    </div>
</div>
<!--/ Navbar pills -->

<!-- User Profile Content -->
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
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
        <div class="row">
            <!-- Connections -->
            <div class="col-lg-12 col-xl-6">
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">Connections</h5>
                        <div class="card-action-element">
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical text-muted"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Share connections</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/avatars/2.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Cecilia Payne</h6>
                                            <small class="text-muted">45 Connections</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-label-primary btn-icon btn-sm"><i class="ti ti-user-check ti-xs"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Curtis Fletcher</h6>
                                            <small class="text-muted">1.32k Connections</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-primary btn-icon btn-sm"><i class="ti ti-user-x ti-xs"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/avatars/10.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Alice Stone</h6>
                                            <small class="text-muted">125 Connections</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-primary btn-icon btn-sm"><i class="ti ti-user-x ti-xs"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/avatars/7.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Darrell Barnes</h6>
                                            <small class="text-muted">456 Connections</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-label-primary btn-icon btn-sm"><i class="ti ti-user-check ti-xs"></i></button>
                                    </div>
                                </div>
                            <li class="mb-3">
                                <div class="d-flex align-items-start">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Eugenia Moore</h6>
                                            <small class="text-muted">1.2k Connections</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <button class="btn btn-label-primary btn-icon btn-sm"><i class="ti ti-user-check ti-xs"></i></button>
                                    </div>
                                </div>
                            </li>
                            <li class="text-center">
                                <a href="javascript:;">View all connections</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Connections -->
            <!-- Teams -->
            <div class="col-lg-12 col-xl-6">
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">Teams</h5>
                        <div class="card-action-element">
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical text-muted"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0);">Share teams</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/icons/brands/react-label.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">React Developers</h6>
                                            <small class="text-muted">72 Members</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/icons/brands/support-label.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Support Team</h6>
                                            <small class="text-muted">122 Members</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="javascript:;"><span class="badge bg-label-primary">Support</span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/icons/brands/figma-label.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">UI Designers</h6>
                                            <small class="text-muted">7 Members</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="javascript:;"><span class="badge bg-label-info">Designer</span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/icons/brands/vue-label.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Vue.js Developers</h6>
                                            <small class="text-muted">289 Members</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-start">
                                        <div class="avatar me-2">
                                            <img src="{{ asset('assets/img/icons/brands/twitter-label.png') }}" alt="Avatar" class="rounded-circle" />
                                        </div>
                                        <div class="me-2 ms-1">
                                            <h6 class="mb-0">Digital Marketing</h6>
                                            <small class="text-muted">24 Members</small>
                                        </div>
                                    </div>
                                    <div class="ms-auto">
                                        <a href="javascript:;"><span class="badge bg-label-secondary">Marketing</span></a>
                                    </div>
                                </div>
                            </li>
                            <li class="text-center">
                                <a href="javascript:;">View all teams</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/ Teams -->
        </div>
        <!-- Projects table -->
        <div class="card mb-4">
            <div class="card-datatable table-responsive">
                <table class="datatables-projects table border-top">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Name</th>
                            <th>Leader</th>
                            <th>Team</th>
                            <th class="w-px-200">Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--/ Projects table -->
    </div>
</div>
<!--/ User Profile Content -->
@endsection