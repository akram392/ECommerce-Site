@extends('backend.layout.template')

@section('page-title')
    <title>Update Division Information | Ecommerce Portal</title>     
@endsection

@section('body-css')

@endsection

@section('body-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-0">Update Division Information</h5>
                        </div>
                        <div class="dropdown options ms-auto">
                            <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('division.update', $division->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="">Division Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Division Name" value="{{ $division->name }}" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Priority Number</label>
                                    <input type="number" name="priority_num" class="form-control" placeholder="Priority Number" value="{{ $division->priority_num }}" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Active Status</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="status">
                                        <option>Please Select the Status</option>
                                        <option value="1" @if ( $division->status == 1) selected @endif >Active</option>
                                        <option value="0" @if ( $division->status == 0) selected @endif  >Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary px-5">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body-script')

@endsection