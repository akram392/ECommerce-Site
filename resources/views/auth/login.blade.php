@extends('auth.layout.template')

@section('page-title')
    <title>Admin Login</title>
@endsection

@section('auth-body')
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                
                    <div class="card shadow-none">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center mb-4">
                                    <h3 class="">Sign in</h3>
                                    <p class="mb-0">Login to your account</p>
                                </div>
                                
                                <div class="form-body">
                                    <!-- Session Status -->
                                     <x-auth-session-status class="mb-4" :status="session('status')" />

                                    <form method="POST" action="{{ route('login') }}" class="row g-4">
                                        @csrf 

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" required autofocus autocomplete="username" value="{{ old('email') }}">

                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Enter Password</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0" id="password" placeholder="Enter Password" required autocomplete="current-password">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                                <a href="javascript:;" class="input-group-text bg-transparent">
                                                    <i class='bx bx-hide'></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                                <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 text-end">
                                            @if (Route::has('password.request'))	
                                                <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>{{ __('Sign in') }}</button>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center">
                                            <p class="mb-0">{{ __('Dont have an account yet?') }} 
                                                <a href="{{ route('register') }}">{{ __('Sign up here') }}</a>
                                            </p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
