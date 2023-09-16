@extends('frontend.layout.template')

@section('page-title')
    <title>Fail | Ecommerce WebSite</title>
@endsection

@section('body-css')

@endsection

@section('body-content')

    <div role="main" class="main">
        <section class="page-header page-header-classic page-header-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                        <h1 data-title-border>Transaction Failed</h1>
                    </div>
                    <div class="col-md-4 order-1 order-md-2 align-self-center">
                        <ul class="breadcrumb d-block text-md-right">
                            <li><a href="{{ route('homepage') }}">Home</a></li>
                            <li class="active">Transaction Failed</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="container pb-1">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Opps! Return to Home Page.</h2>
                    <a href="{{ route('homepage') }}" class="btn btn-primary">Home Page</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body-script')

@endsection
