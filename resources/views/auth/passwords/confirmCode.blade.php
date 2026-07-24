@extends('layouts.app')

@section('content')

<section class="m-top mb-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">

                <div class="widget">

                    <h5 class="widget__title">Confirm Reset Code</h5>

                    <p class="text-muted mb-4">
                        A password reset code has been sent to
                        <strong>{{ $email }}</strong>.
                        Enter the code below to continue.
                    </p>

                    {{-- Success --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Error --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Warning --}}
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

                    {{-- Countdown --}}
                    <div id="countdown-timer" class="alert alert-info text-center fw-bold"></div>

                    <form action="{{ route('submitPasswordResetCode') }}" method="POST" class="widget__form">
                        @csrf

                        <input type="hidden" name="user_email" value="{{ $email }}">

                        <div class="form-group">
                            <input
                                type="text"
                                name="code"
                                class="form-control widget__form-input text-center"
                                placeholder="Enter Verification Code"
                                maxlength="6"
                                value="{{ old('code') }}"
                                autocomplete="one-time-code"
                                required
                            >
                        </div>

                        <div class="widget__form-btn">
                            <button type="submit" class="btn-custom w-100">
                                Verify Code
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a
                                href="{{ route('resend.code', ['email' => $email]) }}"
                                id="resend-btn"
                                class="widget__form-link"
                                style="pointer-events:none;opacity:.5"
                                onclick="localStorage.removeItem('reset-code-expiry-{{ $email }}')"
                            >
                                Resend Verification Code
                            </a>
                        </div>

                        <div class="text-center mt-3">
                            <a href="{{ route('forgetPassword') }}" class="widget__form-link">
                                Back to Forgot Password
                            </a>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const timer = document.getElementById("countdown-timer");
    const resendBtn = document.getElementById("resend-btn");

    const localKey = "reset-code-expiry-{{ $email }}";
    const expiry = {{ $otpExpiresAt ?? 'null' }} * 1000;

    if (!localStorage.getItem(localKey)) {
        localStorage.setItem(localKey, expiry);
    }

    function updateTimer() {

        const expires = parseInt(localStorage.getItem(localKey));
        const now = Date.now();
        const diff = expires - now;

        if (diff <= 0) {

            timer.classList.remove("alert-info");
            timer.classList.add("alert-danger");

            timer.innerHTML = "Your verification code has expired.";

            resendBtn.style.pointerEvents = "auto";
            resendBtn.style.opacity = "1";

            return;
        }

        const minutes = Math.floor(diff / 60000);
        const seconds = Math.floor((diff % 60000) / 1000);

        timer.innerHTML =
            "Code expires in <strong>" +
            minutes +
            "m " +
            String(seconds).padStart(2, "0") +
            "s</strong>";

        setTimeout(updateTimer, 1000);
    }

    updateTimer();

});
</script>
<style>
    /* Verify Code Button */
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
}

.btn-custom:active{
    transform:translateY(0);
}



input[name="code"]:focus{
    border-color:#c8102e;
    box-shadow:0 0 10px rgba(200,16,46,.15);
}

/* Countdown Timer */
#countdown-timer{
    font-size:16px;
    border-radius:8px;
    margin-bottom:20px;
}

/* Resend Link */
#resend-btn{
    font-weight:600;
    transition:.3s;
}

#resend-btn:hover{
    color:#c8102e;
    text-decoration:none;
}
</style>
@endsection