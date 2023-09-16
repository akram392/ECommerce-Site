@extends('auth.layout.template')

@section('page-title')
    <title>Admin Register</title>
@endsection

@section('auth-body')
    <div class="d-flex align-items-center justify-content-center my-lg-0" style="padding-top: 100px">
        <div class="container">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                <div class="col mx-auto">
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center mb-4">
                                    <h3 class="">Sign Up</h3>
                                    <p class="mb-0">Create your account</p>
                                </div>
                                
                                <div class="form-body">
                                    <form method="POST" action="{{ route('register') }}" class="row g-3">
                                        @csrf 

                                        <!-- Name -->
                                        <div class="col-12">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" required autofocus autocomplete="name" value="{{ old('name') }}">

                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                        <!-- Email Address -->
                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="example@user.com" required autocomplete="username">

                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Enter Password" required autocomplete="new-password">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class='bx bx-hide'></i>
                                                </a>
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="col-12">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password_confirmation" class="form-control border-end-0" id="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class='bx bx-hide'></i>
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="col-12">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                                <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>{{ __('Sign up') }}</button>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <p class="mb-0">{{ __('Already have an account?') }} <a href="{{ route('login') }}">{{ __('Sign in here') }}</a>
                                            </p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
@endsection

