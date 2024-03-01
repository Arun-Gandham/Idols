@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : "Product Details View")

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
                <img src="{{ asset($order->product->thumbnail) }}" class="max-width-idol" alt="human image">
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 mt-auto">
                <div class="row">
                    <div class="col-md-6">
                        <small class="card-text text-uppercase">Order Details</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Order Id:</span> <span><strong>{{ $order->order_id }}</strong></span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">User Name:</span> <span>{{ $order->name }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Phone:</span> <span><a href="tel:{{ $order->phone1 }}">{{ $order->phone1 }}</a>, <a href="tel:{{ $order->phone2 }}">{{ $order->phone2 }}</a></span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Address:</span> <span>{{ $order->address }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Price:</span> <span>{{ $order->phone2 }}</span>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Cover Price:</span> <span>{{ $order->address }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Crane Price:</span> <span>{{ $order->note }}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Note:</span> <span>{{ $order->note }}</span></li>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase">Product Details</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Product Name:</span> <span><a href="{{ route('product.details.view',$order->product->id) }}">{{ $order->product->name }}</a></span></li>
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Feet:</span> <span>{{ $order->product->feet->feet }}</span></li>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="status-update-bar mb-4">
    <div class="card">
        <div class="card-body">

            <form class="card-body" method="POST" action="{{ route('order.update.status') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <small class="card-text text-uppercase">Update Status</small>
                    <div class="col-md-6">
                        <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Status</label>
                        <div class="col-sm-11">
                            <select class="form-select" name="status" required="">
                                @foreach ($statuses as $status)
                                <option {{ isset($order) && $status->id === $order->status_id ? 'selected' : '' }} value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class=" col-sm-3 col-md-12 col-form-label" for="multicol-username">Amount</label>
                        <div class="col-sm-11">
                            <input type="number" class="form-control" placeholder="Amount" name="amount">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="col-sm-12 col-form-label" for="multicol-username">Description</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" placeholder="Say it" rows="3" name="description"></textarea>
                        </div>
                    </div>
                    <div class="pt-4">
                        <div class="row justify-content-start">
                            <div class="col-sm-11">
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <button type="submit" class="btn btn-primary me-sm-2 me-1 waves-effect waves-light">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- User Profile Content -->
<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
        <!-- About User -->
        <div class="card mb-4">
            <div class="card-body">
                <small class="card-text text-uppercase">Product Details</small>
                <ul class="list-unstyled mb-4 mt-3">
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-user text-heading"></i><span class="fw-medium mx-2 text-heading">Product Name:</span> <span><a href="{{ route('product.details.view',$order->product->id) }}">{{ $order->product->name }}</a></span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-check text-heading"></i><span class="fw-medium mx-2 text-heading">Body Color:</span> <span>{{ $order->product->body_color }}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-crown text-heading"></i><span class="fw-medium mx-2 text-heading">Pancha/Saree Color:</span> <span>{{ $order->product->pancha_saree_color }}</span></li>
                    <li class="d-flex align-items-center mb-3"><i class="ti ti-flag text-heading"></i><span class="fw-medium mx-2 text-heading">Feet:</span> <span>{{ $order->product->feet->feet }}</span></li>
                </ul>
            </div>
        </div>
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
                        <span class="timeline-point timeline-point-success"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">Order Booked</h6>
                                <small class="text-muted">
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
                                </small>
                            </div>
                            <p class="mb-1">Description: Order Confirmed and booked</p>
                            <p class="mb-2">Amount: ---</p>
                            <div class="d-flex flex-wrap">
                                <div class="avatar me-2">
                                    <img src="{{ asset($order->createdBy->photo) }}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div class="ms-1">
                                    <h6 class="mb-0"><a href="{{ route('user.profile.view',$order->createdBy->id) }}">{{ $order->createdBy->name }}</a></h6>
                                    <span><a ref="tel:{{ $order->createdBy->phone }}">{{ $order->createdBy->phone }}</a></span>
                                </div>
                            </div>
                        </div>
                    </li>
                    @foreach($order->orderTimeline as $timeline)
                    <li class="timeline-item timeline-item-transparent">
                        <span class="timeline-point timeline-point-{{ $timeline->is_deleted === 1 ? 'danger' : 'info' }}"></span>
                        <div class="timeline-event">
                            <div class="timeline-header">
                                <h6 class="mb-0">{{ isset($timeline->timelineStatus->name) ? $timeline->timelineStatus->name : "---" }} 
                                    @if($timeline->is_deleted === 0)
                                    <a data-bs-toggle="modal" style="cursor: pointer;" data-bs-target="#modalCenter" id="deleteButton" data-url="{{ route('order.timeline.delete',$timeline->id) }}">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                    @endif
                                </h6>
                                <small class="text-muted">
                                    @php
                                    $dateTime = new DateTime($timeline->created_at);
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
                                </small>
                            </div>
                            <p class="mb-1">Description: {{ isset($timeline->description) ? $timeline->description : "---" }}</p>
                            <p class="mb-2">Amount: {{ isset($timeline->amount) ? $timeline->amount : "---" }}</p>
                            <div class="d-flex flex-wrap">
                                <div class="avatar me-2">
                                    <img src="{{ asset($timeline->createdBy->photo) }}" alt="Avatar" class="rounded-circle" />
                                </div>
                                <div class="ms-1">
                                    <h6 class="mb-0"><a href="{{ route('user.profile.view',$timeline->createdBy->id) }}">{{ $timeline->createdBy->name }}</a></h6>
                                    <span><a ref="tel:{{ $timeline->createdBy->phone }}">{{ $timeline->createdBy->phone }}</a></span>
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


<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Are you sure to delete?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Amount will not be calculated any more are this status will be marked as deleted.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Get a reference to the delete button and the modal
    var deleteButton = document.getElementById('deleteButton');
    var modal = new bootstrap.Modal(document.getElementById('modalCenter'));

    // Add click event listener to the delete button
    deleteButton.addEventListener('click', function() {
        // Show the modal
        modal.show();
    });

    // Function to handle deletion when the user confirms in the modal
    function confirmDelete() {
        // Get the delete URL from the data-url attribute of the delete button
        var deleteUrl = deleteButton.getAttribute('data-url');

        // Redirect the user to the delete URL
        window.location.href = deleteUrl;

        // Optionally, you can also close the modal after redirection
        modal.hide();
    }
</script>

@endsection