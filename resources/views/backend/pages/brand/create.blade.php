@extends('backend.layout.template')

@section('page-title')
    <title>Add New Brand | Ecommerce Portal</title>     
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
                            <h5 class="mb-0">Add New Brand</h5>
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
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="">Brand Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Brand Name" required autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="">Active Status</label>
                                    <select class="form-select mb-3" aria-label="Default select example" name="status">
                                        <option>Please Select the Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                                <div class="mb-3">
									<label for="formFile" class="form-label">Logo Image</label>
									<input class="form-control" name="image" type="file" id="formFile">
								</div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="">Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Write Description"></textarea>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary px-5">Add New Brand</button>
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
