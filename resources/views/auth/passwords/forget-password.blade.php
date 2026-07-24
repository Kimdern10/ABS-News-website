@extends('layouts.app')

@section('content')

<section class="m-top mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">

                <div class="widget">

                    <h5 class="widget__title">Forgot Password</h5>

                    <p class="text-muted mb-4">
                        Enter your registered email address below. We'll send you a verification code to reset your password.
                    </p>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Status Message --}}
                    @if(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- Error Message --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Warning Message --}}
                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('forgotPassword.email') }}" method="POST" class="widget__form">
                        @csrf

                        <div class="form-group">
                            <input
                                type="email"
                                class="form-control widget__form-input"
                                placeholder="Email Address *"
                                name="email"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
                            >
                        </div>

                        <div class="widget__form-btn">
                            <button type="submit" class="btn-custom w-100">
                                Send Reset Code
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="widget__form-link">
                                Back to Login
                            </a>
                        </div>

                        <div class="text-center mt-2">
                            <span class="widget__form-text">
                                Don't have an account?
                            </span>

                            <a href="{{ route('sign-up') }}" class="widget__form-link">
                                Create Account
                            </a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

<style> 
/* Auth Buttons */
.btn-custom{
    width:100%;
    height:54px;
    border:none;
    border-radius:8px;
    background:linear-gradient(135deg,#c8102e,#e53935);
    color:#fff;
    font-size:15px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:1px;
    cursor:pointer;
    transition:all .3s ease;
    box-shadow:0 5px 15px rgba(200,16,46,.25);
}

.btn-custom:hover{
    background:linear-gradient(135deg,#111,#333);
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(0,0,0,.25);
}

.btn-custom:focus{
    outline:none;
    color:#fff;
    box-shadow:0 0 0 4px rgba(200,16,46,.2);
}

.btn-custom:active{
    transform:translateY(0);
}

.widget__form-btn{
    margin-top:20px;
}
</style>
@endsection