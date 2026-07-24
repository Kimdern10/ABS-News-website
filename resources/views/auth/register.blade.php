@extends('layouts.app')

@section('content')

<section class="m-top mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="widget">

                    <h5 class="widget__title">Create Account</h5>

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

                    @if(session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
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

                    <form class="widget__form contact_form" method="POST" action="{{ route('create-user') }}">
                        @csrf

                        <div class="form-group">
                            <input
                                type="text"
                                class="form-control widget__form-input"
                                placeholder="Full Name *"
                                name="name"
                                value="{{ old('name') }}"
                                required
                            >
                        </div>

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

                        <div class="form-group">
                            <input
                                type="password"
                                class="form-control widget__form-input"
                                placeholder="Confirm Password *"
                                name="confirm_password"
                                required
                            >
                        </div>

                       <div class="widget__form-controls form-group">

    <!-- Remember Me -->
    <!-- <div class="form-check mb-2">
        <input
            type="checkbox"
            class="form-check-input"
            id="remember"
            name="remember"
        >
        <label class="form-check-label" for="remember">
            Remember Me
        </label>
    </div> -->

    <!-- Terms & Privacy -->
    <div class="form-check">
        <input
            type="checkbox"
            class="form-check-input"
            id="terms"
            name="terms"
            required
        >
        <label class="form-check-label" for="terms">
            I agree to the
            <a href="{{ route('terms') }}" target="_blank">
                Terms & Conditions
            </a>
            and
            <a href="{{ route('privacy') }}" target="_blank">
                Privacy Policy
            </a>
        </label>
    </div>

</div>

                        <div class="widget__form-btn">
                            <button type="submit" class="btn-custom">
                                Create Account
                            </button>
                        </div>

                        <p class="widget__form-text text-center mt-3">
                            Already have an account?
                            <a href="{{ route('login') }}" class="widget__form-link">
                                Login
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
    /* Create Account Button */
.btn-custom {
    width: 100%;
    background: #e41e26;
    color: #fff;
    border: none;
    padding: 14px 25px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-custom:hover {
    background: #c5161d;
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(228, 30, 38, 0.3);
}

.btn-custom:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(228, 30, 38, 0.2);
}

.btn-custom:active {
    transform: translateY(0);
}
</style>