@extends('auth.layout.template')

@section('page-title')
    <title>Forgot Password</title>
@endsection

@section('auth-body')
    <div class="authentication-forgot d-flex align-items-center justify-content-center">
        <div class="card forgot-box shadow-none">
            <div class="card-body">
                <div class="p-4 rounded  border">
                    <div class="text-center">
                        <img src="{{ asset('backend/images/icons/forgot-2.png') }}" width="120" alt="" />
                    </div>
                    <h4 class="mt-5 font-weight-bold">{{ __('Confirm Your Password.') }}</h4>

                    <!-- Session Status -->
                     <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <!-- Password -->
                        <div class="my-4">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" class="form-control form-control-lg" placeholder="Enter Your Password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('Confirm Password') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

