@extends('backend.layout.template')

@section('page-title')
    <title>Add New Product | Ecommerce Portal</title>
@endsection

@section('body-css')

@endsection

@section('body-content')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title">Add New Product</h5>
                    <hr>
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-body mt-4">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Product Title</label>
                                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title" placeholder="Enter product title" autocomplete="off" autofocus required>
                                        </div>
                                            <div class="mb-3">
                                            <label for="short_desc" class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" rows="3"></textarea>
                                        </div>
                                            <div class="mb-3">
                                            <label for="long_desc" class="form-label">Description</label>
                                            <textarea class="form-control" name="long_desc" id="long_desc" rows="5"></textarea>
                                        </div>
                                            <div class="mb-3">
                                            <label for="inputProductDescription" class="form-label">Product Images</label>
                                            <input id="image-uploadify" type="file" accept=".xlsx,.xls,image/*,.doc,audio/*,.docx,video/*,.ppt,.pptx,.txt,.pdf" multiple="" style="display: none;"><div class="imageuploadify well"><div class="imageuploadify-overlay"><i class="fa fa-picture-o"></i></div><div class="imageuploadify-images-list text-center"><i class="bx bxs-cloud-upload"></i><span class="imageuploadify-message">Drag&amp;Drop Your File(s)Here To Upload</span><button type="button" class="btn btn-default">or select file to upload</button></div></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="border border-3 p-4 rounded">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label for="regular_price" class="form-label">Regular Price [ BDT ]</label>
                                                <input type="text" name="regular_price" class="form-control" value="{{ old('regular_price') }}" id="regular_price" placeholder="00.00" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="offer_price" class="form-label">Offer Price [ BDT ]</label>
                                                <input type="text" name="offer_price" class="form-control" value="{{ old('offer_price') }}" id="offer_price" placeholder="00.00">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="quantity" class="form-label">Stock Quantity</label>
                                                <input type="text" name="quantity" class="form-control" value="{{ old('quantity') }}" id="quantity" placeholder="00.00" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="is_featured" class="form-label">Product Featured</label>
                                                <select class="form-select" id="is_featured" name="is_featured">
                                                    <option>Please Select the Featured Status</option>
                                                    <option value="1">On Sale</option>
                                                    <option value="0">Regular Product</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="brand_id" class="form-label">Select the Brand</label>
                                                <select class="form-select" name="brand_id" id="brand_id">
                                                    <option>Please Select the Brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label for="category_id" class="form-label">Select the Category</label>
                                                <select class="form-select" name="category_id" id="category_id">
                                                    <option>Please Select the Category</option>
                                                    @foreach ($pcategories as $pCat)
                                                        <option value="{{ $pCat->id }}">{{ $pCat->name }}</option>
                                                        @foreach (App\Models\Category::orderBy('name', 'asc')->where('is_parent', $pCat->id)->get() as $cCat )
                                                            <option value="{{ $cCat->id }}">-- {{ $cCat->name }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-12">
                                                <label for="status" class="form-label">Product Status</label>
                                                <select class="form-select" id="status" name="status">
                                                    <option>Please Select the Product Status</option>
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary">Publish Product</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </div>
                            </div><!--end row-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body-script')

@endsection
