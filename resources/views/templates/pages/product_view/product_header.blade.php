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
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">Available Stock:</span> <span>{{ $product->stock - $product->getOrderStatusCount() }}</span></li>
                            @foreach($statues as $status)
                            <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-medium mx-2 text-heading">{{ $status->name }}:</span> <span>{{ $product->getOrderStatusCount($status->id) }}</span></li>
                            @endforeach
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
