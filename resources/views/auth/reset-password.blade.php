@extends('auth.layout.template')

@section('page-title')
    <title>Reset Password</title>
@endsection

@section('auth-body')
    <div class="authentication-reset-password d-flex align-items-center justify-content-center">
        <div class="row">
            <div class="col-12 col-lg-10 mx-auto">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-lg-5 border-end">
                            <div class="card-body">
                                <div class="p-5">
                                    <div class="text-start">
                                        <img src="{{ asset('backend/images/logo-img.png') }}" width="180" alt="">
                                    </div>
                                    <h4 class="mt-5 font-weight-bold">{{ __('Genrate New Password') }}</h4>
                                    <p class="text-muted">{{ __('We received your reset password request. Please enter your new password!') }}</p>

                                    <form method="POST" action="{{ route('password.store') }}">
                                        @csrf

                                        <!-- Password Reset Token -->
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                        <!-- Email Address -->
                                        <div class="mb-3 mt-5">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" name="email" class="form-control" placeholder="Enter Your Email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="email" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <!-- Password -->                           
                                        <div class="mb-3 mt-5">
                                            <label for="password" class="form-label">New Password</label>
                                            <input id="password" type="password" name="password" class="form-control" placeholder="Enter new password" required autocomplete="new-password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                                            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required autocomplete="new-password" />
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>

                                        <div class="d-grid gap-2">
                                            <button type="submit" class="btn btn-primary">{{ __('Change Password') }}</button> <a href="authentication-login.html" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <img src="{{ asset('backend/images/login-images/forgot-password-frent-img.jpg') }}" class="card-img login-img h-100" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

