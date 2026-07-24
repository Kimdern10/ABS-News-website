@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('profile') }}">My Account</a></li>
            <li class="breadcrumb-item active">Edit Profile</li>
        </ol>
    </nav>

    <h1 class="display-5 fw-bold mb-4 text-dark">Edit Profile</h1>

    <div class="row g-4">
        
        <!-- Left Column: Profile Overview -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100 rounded-4 overflow-hidden">
                <!-- Cover Banner -->
               <div class="d-flex justify-content-center align-items-center bg-light"
     style="height: 180px;">
    <i class="fa-solid fa-circle-user"
       style="font-size: 100px; color: #c71111;"></i>

                    
                    <!-- Floating Profile Picture -->
                    <div class="position-absolute start-50 translate-middle" style="top: 110px;">
                        <div class="profile-image-wrapper position-relative">
                            @php
                                $firstLetter = strtoupper(substr($user->name, 0, 1));
                            @endphp
                            <img id="profile-preview"
                                src="{{ optional($user->Userprofile)->profile_picture 
                                    ? asset('Userprofile/' . $user->Userprofile->profile_picture) 
                                    : asset('assets/img/user/1.jpg') }}"
                                alt="{{ $user->name }}"
                                class="rounded-circle border border-4 border-white shadow"
                                style="width: 140px; height: 140px; object-fit: cover;"
                                onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 width=%27140%27 height=%27140%27 viewBox=%270 0 140 140%27%3E%3Ccircle cx=%2770%27 cy=%2770%27 r=%2770%27 fill=%27%23e41e26%27/%3E%3Ctext x=%2770%27 y=%27100%27 font-size=%2770%27 text-anchor=%27middle%27 fill=%27%23ffffff%27 font-family=%27Arial%27 font-weight=%27bold%27%3E{{ $firstLetter }}%3C/text%3E%3C/svg%3E'">
                            
                            <label for="profile-upload" 
                                   class="upload-overlay position-absolute bottom-0 end-0 bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                                   style="width: 42px; height: 42px; cursor: pointer;">
                                <i class="fas fa-camera"></i>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card-body text-center pt-5 mt-4">
                    <h4 class="mb-1">{{ $user->name }}</h4>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    
                    <div class="d-flex justify-content-center gap-3 text-muted small">
                        <div>Member since <strong>{{ $user->created_at->format('Y') }}</strong></div>
                    </div>

                    <hr class="my-4">
                    
    <form id="profile-upload-form"
      action="{{ route('profile.photo') }}"
      method="POST"
      enctype="multipart/form-data">
    @csrf

    <input type="file"
           id="profile-upload"
           name="profile_picture"
           accept="image/*"
           hidden
           onchange="previewImage(event)">

    <button type="submit" class="btn btn-outline-danger px-4">
        Change Photo
    </button>
</form>
                </div>
            </div>
        </div>

        <!-- Right Column: Forms -->
        <div class="col-lg-8">
            
            <!-- Personal Information -->
            <div class="card shadow-sm border-0 rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="mb-0 text-danger"><i class="fas fa-user-edit"></i> Personal Information</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control form-control-lg rounded-3" 
                                       value="{{ old('name', $user->name) }}">
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control form-control-lg rounded-3" 
                                       value="{{ old('email', $user->email) }}">
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Phone Number</label>
                                <input type="tel" name="phone" class="form-control form-control-lg rounded-3" 
                                       value="{{ old('phone', optional($user->Userprofile)->phone ?? '') }}">
                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label">Address</label>
                                <textarea name="address" rows="3" class="form-control form-control-lg rounded-3">{{ old('address', optional($user->Userprofile)->address ?? '') }}</textarea>
                                @error('address') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-danger px-5 py-2 rounded-3">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Change Password -->
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="mb-0 text-danger"><i class="fas fa-lock"></i> Change Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                      

                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control form-control-lg rounded-3">
                            @error('current_password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" class="form-control form-control-lg rounded-3">
                            @error('password') <span class="text-danger small">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg rounded-3">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-danger px-5 py-2 rounded-3">
                                Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('profile-preview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection