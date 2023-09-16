@extends('backend.layout.template')

@section('page-title')
    <title>Add New User | Ecommerce Portal</title>
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
                            <h5 class="mb-0">Add New User</h5>
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
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="">User Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="User Name" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Email Address</label>
                                    <input type="email" name="email" class="form-control" placeholder="Email Address" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">User Role</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="is_admin">
                                        <option>Please Select the Role</option>
                                        <option value="1" >Super Admin</option>
                                        <option value="2" >Customer</option>
                                    </select>
                                </div>
                                <div class="mb-3">
									<label for="formFile" class="form-label">User Image</label>
									<input class="form-control" name="image" type="file" id="formFile">
								</div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone No." required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Address Line 01</label>
                                    <input type="text" name="address_line1" class="form-control" placeholder="Address Line 01" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Address Line 02</label>
                                    <input type="text" name="address_line2" class="form-control" placeholder="Address Line 02" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Country Name</label>
                                    <input type="text" name="country_name" class="form-control" placeholder="Country Name" required autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="">Division Name</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="division_id">
                                        <option>Please Select the Division</option>
                                        @foreach ($divisions as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">District Name</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="district_id">
                                        <option>Please Select the District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                <div class="mb-3">
                                    <label for="">Zip Code</label>
                                    <input type="text" name="zipCode" class="form-control" placeholder="Zip Code" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary px-5">Add New User</button>
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
