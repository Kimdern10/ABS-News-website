<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = User::with('Userprofile')->find(Auth::id());
        return view('profile.edit', compact('user'));
    }
public function update(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:225',
        'phone' => [
            'nullable',
            'string',
            'max:15',
            function ($attribute, $value, $fail) {
                if ($value && strlen(preg_replace('/[^0-9]/', '', $value)) != 11) {
                    $fail('The phone number must be exactly 11 digits.');
                }
            },
        ],
        'address' => 'nullable|string',
        'bio' => 'nullable|string',
    ], [
        'name.required' => 'Please enter your full name',
        'phone.max' => 'Phone number cannot exceed 15 characters',
    ]);

    $user = Auth::user();

    $user->update([
        'name' => $request->name,
    ]);

    Userprofile::updateOrCreate(
        ['user_id' => $user->id],
        [
            'phone'   => $request->phone,
            'address' => $request->address,
            'bio'     => $request->bio,
        ]
    );

    return back()->with('profile_success', 'Profile updated successfully.');
}


public function passwordUpdate(Request $request)
{
    $request->validate([
        'current_password' => ['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed', 'different:current_password'],
    ], [
        'current_password.required' => 'Please enter your current password.',
        'password.required' => 'Please enter a new password.',
        'password.min' => 'The new password must be at least 8 characters.',
        'password.confirmed' => 'The password confirmation does not match.',
        'password.different' => 'Your new password must be different from your current password.',
    ]);

    $user = Auth::user();

    // Verify current password
    if (!Hash::check($request->current_password, $user->password)) {
        return back()
            ->withErrors([
                'current_password' => 'The current password you entered is incorrect.',
            ])
            ->withInput();
    }

    // Prevent reusing the current password
    if (Hash::check($request->password, $user->password)) {
        return back()
            ->withErrors([
                'password' => 'Your new password cannot be the same as your current password.',
            ]);
    }

    $user->update([
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('profile')
        ->with('success', 'Your password has been updated successfully.');
}

public function updatePhoto(Request $request)
{
    $request->validate([
        'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    $user = Auth::user();

    $profile = Userprofile::firstOrCreate([
        'user_id' => $user->id,
    ]);

    if ($request->hasFile('profile_picture')) {

        // Delete old image
        if (
            $profile->profile_picture &&
            file_exists(public_path('Userprofile/' . $profile->profile_picture))
        ) {
            unlink(public_path('Userprofile/' . $profile->profile_picture));
        }

        $image = $request->file('profile_picture');
        $filename = time() . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('Userprofile'), $filename);

        $profile->update([
            'profile_picture' => $filename,
        ]);
    }

    return back()->with('profile_success', 'Profile picture updated successfully.');
}

}