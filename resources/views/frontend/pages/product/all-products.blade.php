@extends('frontend.layout.template')

@section('page-title')
    <title>All Products | Ecommerce WebSite</title>
@endsection

@section('body-css')

@endsection

@section('body-content')
    <div role="main" class="main shop py-4">

		<div class="container">

			<div class="masonry-loader masonry-loader-showing">
				<div class="row products product-thumb-info-list" data-plugin-masonry data-plugin-options="{'layoutMode': 'fitRows'}">
                    @foreach ( $products as $product )
                        <div class="col-12 col-sm-6 col-lg-3 product">

                            {{-- On Sale Design --}}
                            @if ( $product->is_featured == 1 )
                                <a href="{{ route('pdetails', $product->slug ) }}">
                                    <span class="onsale">Sale!</span>
                                </a>
                            @endif

                            <span class="product-thumb-info border-0">
                                {{-- Add To Cart --}}
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    @if (!is_null($product->offer_price))
                                        <input type="hidden" name="unit_price" value="{{ $product->offer_price }}">
                                    @else
                                        <input type="hidden" name="unit_price" value="{{ $product->regular_price }}">
                                    @endif
                                    <button type="submit" class="add-to-cart-product bg-color-primary w-100" style="border: none">
                                        <span class="text-uppercase text-1">Add to Cart</span>
                                    </button>
                                </form>

                                {{-- Image Thumbnail --}}
                                <a href="{{ route('pdetails', $product->slug ) }}">
                                    <span class="product-thumb-info-image">
                                        <img alt="" class="img-fluid" src="{{ asset('frontend/img/products/product-grey-1.jpg') }}">
                                    </span>
                                </a>

                                <span class="product-thumb-info-content product-thumb-info-content pl-0 bg-color-light">
                                    <a href="{{ route('pdetails', $product->slug ) }}">
                                        <h4 class="text-4 text-primary">{{ $product->title }}</h4>

                                        @if (!is_null($product->offer_price))
                                            <span class="price">
                                                <del><span class="amount">{{ $product->regular_price }} BDT </span></del>
                                                <ins><span class="amount text-dark font-weight-semibold">{{ $product->offer_price }} BDT </span></ins>
                                            </span>
                                        @else
                                            <span class="price">
                                                <ins><span class="amount text-dark font-weight-semibold">{{ $product->regular_price }} BDT </span></ins>
                                            </span>
                                        @endif

                                    </a>
                                </span>

                            </span>
                        </div>
                    @endforeach
				</div>
				<div class="row">
					<div class="col">
						{{-- <ul class="pagination float-right">
							<li class="page-item"><a class="page-link" href="#"><i class="fas fa-angle-left"></i></a></li>
							<li class="page-item active"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<a class="page-link" href="#"><i class="fas fa-angle-right"></i></a>
						</ul> --}}
					</div>
				</div>
			</div>

		</div>

	</div>
@endsection

@section('body-script')

@endsection
