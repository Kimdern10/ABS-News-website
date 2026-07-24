<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';


public function authenticated()
{
    $user = Auth::user();

    // Check if account is active
    if (!$user->active) {
        Auth::logout();

        return redirect()->route('login')
            ->with('error', 'Your account has been banned. Please contact support.');
    }

    /*
    |--------------------------------------------------------------------------
    | Super Admin, Admin & Editor
    |--------------------------------------------------------------------------
    */
    if ($user->hasAnyRole(['super-admin', 'admin', 'editor'])) {

        return redirect()->route('admin.dashboard')
            ->with('success', 'Welcome '.$user->name);
    }

    /*
    |--------------------------------------------------------------------------
    | Regular User
    |--------------------------------------------------------------------------
    */
    if ($user->hasRole('user')) {

        // Check email verification
        if (!$user->email_verified_at) {

            if (!$user->email_verification_otp) {

                $otp = rand(100000, 999999);

                $user->update([
                    'email_verification_otp' => $otp,
                ]);

                try {
                    Mail::to($user->email)->send(new OtpMail($otp));
                } catch (\Exception $e) {

                    Log::error('Failed to send OTP email: '.$e->getMessage());

                    Auth::logout();

                    return redirect()->route('verify.otp', [
                        'email' => $user->email,
                    ])->with('warning', 'Unable to send OTP email.');
                }
            }

            Auth::logout();

            return redirect()->route('verify.otp', [
                'email' => $user->email,
            ])->with('error', 'Please verify your email address first.');
        }

        return redirect()->route('user.dashboard')
            ->with('success', 'Logged in successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | No Role Assigned
    |--------------------------------------------------------------------------
    */
    Auth::logout();

    return redirect()->route('login')
        ->with('error', 'No role has been assigned to your account.');
}

public function __construct()
{
    $this->middleware('guest')->except('logout');
    $this->middleware('auth')->only('logout');
}

}
