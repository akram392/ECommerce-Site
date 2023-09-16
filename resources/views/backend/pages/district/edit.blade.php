@extends('backend.layout.template')

@section('page-title')
    <title>Update District Information | Ecommerce Portal</title>     
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
                    <form action="{{ route('district.update', $district->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="">District Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="District Name" value="{{ $district->name }}" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Division Name</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="division_id">
                                        <option>Please Select the Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}"
                                            
                                            @if ( $division->id == $district->division_id )
                                                selected
                                            @endif

                                            >{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Active Status</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="status">
                                        <option>Please Select the Status</option>
                                        <option value="1" @if ( $district->status == 1) selected @endif >Active</option>
                                        <option value="0" @if ( $district->status == 0) selected @endif  >Inactive</option>
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