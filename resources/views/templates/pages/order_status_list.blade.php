@extends('layouts/layoutMaster')

@section('title', isset($pageSettings['title']) ? $pageSettings['title'] : 'Roles List')

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


    <div class="d-flex justify-content-between">
        <h4 class="py-3 mb-3">
            <span class="text-muted fw-light">Role/</span> List
        </h4>
        <a href="{{ route('order.status.add') }}"><button class="btn btn-primary mt-2"
                style="padding: 15px;height: 30px;"><i class="fa-solid fa-plus"></i>
                Add</button></a>
    </div>

    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive pt-0">
            <table id="data-table" class="datatables-basic table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statuses as $status)
                        <tr>
                            <td>{{ $status->name }}</td>
                            <td>
                                <a href="{{ route('order.status.edit', ['id' => $status->id]) }}"
                                    class="text-success me-2"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ route('order.status.delete', ['id' => $status->id]) }}"
                                    class="text-danger ms-2"><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
