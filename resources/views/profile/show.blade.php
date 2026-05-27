@extends('layouts.app')
@section('page-title', 'My Profile')
@php use Illuminate\Support\Facades\Storage; @endphp

@section('content')
<div class="row g-3 justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="bi bi-person-circle" style="color:var(--porsche-red);"></i> Profile Information
            </div>
            <div class="card-body">

                {{-- Profile Picture --}}
                <div class="text-center mb-4">
                    @if($user->profile_picture)
                        <img src="{{ Storage::url($user->profile_picture) }}"
                             class="rounded-circle mb-2"
                             style="width:90px;height:90px;object-fit:cover;border:3px solid var(--porsche-red);">
                    @else
                        <div class="avatar-placeholder mx-auto mb-2"
                             style="width:90px;height:90px;font-size:2rem;">
                            {{ strtoupper(substr($user->name,0,1)) }}
                        </div>
                    @endif
                    <div class="fw-bold fs-5">{{ $user->name }}</div>
                    <div class="text-muted" style="font-size:0.85rem;">{{ $user->email }}</div>
                    <div class="text-muted" style="font-size:0.75rem;">Member since {{ $user->created_at->format('F Y') }}</div>
                </div>

                @if($errors->any())
                <div class="alert alert-danger py-2 mb-3" style="font-size:0.85rem;">
                    <ul class="mb-0 ps-3">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">— Select —</option>
                                @foreach(['Male','Female','Other'] as $g)
                                <option value="{{ $g }}" {{ old('gender', $user->gender) === $g ? 'selected' : '' }}>{{ $g }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" placeholder="Optional">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Password <span class="text-muted fw-normal">(leave blank to keep)</span></label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile_picture" class="form-control" accept="image/*">
                            <div class="form-text">Max 2MB. JPG, PNG, GIF.</div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-porsche px-4">
                                <i class="bi bi-check-lg me-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
