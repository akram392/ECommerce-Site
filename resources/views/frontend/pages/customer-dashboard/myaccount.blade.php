
@extends('frontend.layout.template')

@section('page-title')
    <title>Customer Dashboard | Ecommerce WebSite</title>
@endsection

@section('body-css')

@endsection

@section('body-content')
	<div role="main" class="main">

		<section class="page-header page-header-classic">
			<div class="container">
				<div class="row">
					<div class="col">
						<ul class="breadcrumb">
							<li><a href="#">Home</a></li>
							<li class="active">Pages</li>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col p-static">
						<h1 data-title-border>User - {{ Auth::user()->name }}</h1>

					</div>
				</div>
			</div>
		</section>

		<div class="container py-2">
            <form action="{{ route('dashboard.update', Auth::user()->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data" >
                @csrf
                <div class="row">
                        <div class="col-lg-3 mt-4 mt-lg-0">

                            <div class="d-flex justify-content-center mb-4">
                                <div class="profile-image-outer-container">
                                    <div class="profile-image-inner-container bg-color-primary">
                                        {{-- <img src="{{ asset('frontend/img/avatars/avatar.jpg') }}"> --}}
                                        @if ( !is_null( Auth::user()->image ) )
                                            <img src="{{ asset('images/user/' . Auth::user()->image ) }}" alt="" width="35">
                                        @else
                                            <img src="{{ asset('frontend/img/avatars/avatar.jpg') }}" alt="" width="35">
                                        @endif
                                        <span class="profile-image-button bg-color-dark">
                                            <i class="fas fa-camera text-light"></i>
                                        </span>
                                    </div>
                                    <input class="form-control profile-image-input" id="file" name="image" type="file" id="formFile">
                                </div>
                            </div>

                            <aside class="sidebar mt-2" id="sidebar">
                                <ul class="nav nav-list flex-column mb-5">
                                    <li class="nav-item"><a class="nav-link text-dark active" href="#">My Profile</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">User Preferences</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Billing</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Invoices</a></li>
                                </ul>
                            </aside>

                        </div>
                        <div class="col-lg-9">

                            <div class="overflow-hidden mb-1">
                                <h2 class="font-weight-normal text-7 mb-0"><strong class="font-weight-extra-bold">My</strong> Profile</h2>
                            </div>
                            <div class="overflow-hidden mb-4 pb-3">
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>

                            {{-- <form action="{{ route('dashboard.update', Auth::user()->id) }}" method="POST" role="form" class="needs-validation" enctype="multipart/form-data">
                                @csrf --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">Full name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="name" required type="text" value="{{ Auth::user()->name }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="email" required type="email" value="{{ Auth::user()->email }}" readonly >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Phone</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="phone" type="text" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Address Line</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="address_line1" type="text" value="{{ Auth::user()->address_line1 }}" placeholder="Street">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Address Line (Optonal)</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="address_line2" type="text" value="{{ Auth::user()->address_line2 }}" placeholder="Street">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">District</label>
                                    <div class="col-lg-9">
                                        <select class="form-select mb-3" aria-label="Default select example" name="district_id">
                                            <option>Please Select the District</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}"

                                                @if ( $district->id == Auth::user()->district_id )
                                                    selected
                                                @endif

                                                >{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Division</label>
                                    <div class="col-lg-9">
                                        <select class="form-select mb-3" aria-label="Default select example" name="division_id">
                                            <option>Please Select the Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}"

                                                @if ( $division->id == Auth::user()->division_id )
                                                    selected
                                                @endif

                                                >{{ $division->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Country</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="country_name" type="text" value="{{ Auth::user()->country_name }}" placeholder="Country_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Zip Code</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="zipCode" type="text" value="{{ Auth::user()->zipCode }}" placeholder="Zip Code">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">Time Zone</label>
                                    <div class="col-lg-9">
                                        <select id="user_time_zone" class="form-control" size="0">
                                            <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                            <option value="Alaska">(GMT-09:00) Alaska</option>
                                            <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                            <option value="Arizona">(GMT-07:00) Arizona</option>
                                            <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                            <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                            <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                            <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 ">Current Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="password"  name="oldPassword" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 "> New Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="password" name="password" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 ">Confirm password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="password" name="password_confirmation" >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="form-group col-lg-9"></div>
                                    <div class="form-group col-lg-3">
                                        <button type="submit" class="btn btn-primary btn-modern float-right" data-loading-text="Loading...">Save</button>
                                    </div>
                                </div>
                            {{-- </form> --}}
                        </div>
                </div>
            </form>
		</div>
	</div>
@endsection

@section('body-script')

@endsection
