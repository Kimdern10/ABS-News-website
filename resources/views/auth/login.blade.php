@extends('layouts.app')

@section('content')

<section class="m-top mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="widget">

                    <h5 class="widget__title">Login</h5>

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="widget__form">
                        @csrf

                        <div class="form-group">
                            <input
                                type="email"
                                class="form-control widget__form-input"
                                placeholder="Email Address *"
                                name="email"
                                value="{{ old('email') }}"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <input
                                type="password"
                                class="form-control widget__form-input"
                                placeholder="Password *"
                                name="password"
                                required
                            >
                        </div>

                        <div class="widget__form-controls form-group d-flex justify-content-between align-items-center">

                            <div class="widget__form-controls-checkbox">
                                <input
                                    type="checkbox"
                                    id="remember"
                                    class="widget__form-controls-input"
                                    name="remember"
                                    {{ old('remember') ? 'checked' : '' }}
                                >

                                <label class="widget__form-controls-label" for="remember">
                                    Remember Me
                                </label>
                            </div>

                            <a href="{{ route('forgetPassword') }}" class="widget__form-link">
                                Forgot Password?
                            </a>

                        </div>

                        <div class="widget__form-btn">
                            <button type="submit" class="btn-custom">
                                Login
                            </button>
                        </div>

                        <p class="widget__form-text text-center mt-3">
                            Don't have an account?
                            <a href="{{ route('sign-up') }}" class="widget__form-link">
                                Create Account
                            </a>
                        </p>

                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

<style>
    /* Login Button */
.btn-custom{
    width:100%;
    height:52px;
    border:none;
    border-radius:6px;
    background:#d71920; /* ABS red */
    color:#fff;
    font-size:16px;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:1px;
    cursor:pointer;
    transition:all .3s ease;
    box-shadow:0 4px 12px rgba(215,25,32,.25);
}

.btn-custom:hover{
    background:#111;
    color:#fff;
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(0,0,0,.25);
}

.btn-custom:focus{
    outline:none;
    color:#fff;
}

.btn-custom:active{
    transform:translateY(0);
}

.widget__form-btn{
    margin-top:20px;
}
</style>