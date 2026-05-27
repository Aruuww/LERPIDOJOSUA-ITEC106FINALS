@extends('layouts.app')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo">
            <div class="crest">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 110" width="64" height="64">
                    <path d="M50 4 L88 18 L88 58 Q88 84 50 98 Q12 84 12 58 L12 18 Z" fill="#1a1a1a" stroke="#c9a84c" stroke-width="2.5"/>
                    <path d="M50 4 L12 18 L12 54 L50 54 Z" fill="#D5001C"/>
                    <path d="M50 4 L88 18 L88 54 L50 54 Z" fill="#D5001C"/>
                    <path d="M12 54 L12 58 Q12 70 22 78 L22 54 Z" fill="#1a1a1a"/>
                    <path d="M88 54 L88 58 Q88 70 78 78 L78 54 Z" fill="#1a1a1a"/>
                    <line x1="50" y1="4" x2="50" y2="98" stroke="#c9a84c" stroke-width="1.5"/>
                    <line x1="12" y1="54" x2="88" y2="54" stroke="#c9a84c" stroke-width="1.5"/>
                    <ellipse cx="50" cy="33" rx="9" ry="12" fill="#c9a84c"/>
                    <ellipse cx="55" cy="23" rx="4" ry="5" fill="#c9a84c" transform="rotate(-15,55,23)"/>
                    <rect x="44" y="43" width="2.5" height="7" rx="1" fill="#c9a84c"/>
                    <rect x="48" y="43" width="2.5" height="8" rx="1" fill="#c9a84c"/>
                    <rect x="52" y="43" width="2.5" height="7" rx="1" fill="#c9a84c"/>
                    <path d="M53 21 Q59 13 57 9" stroke="#c9a84c" stroke-width="1.8" fill="none" stroke-linecap="round"/>
                    <path d="M55 19 Q62 15 61 11" stroke="#c9a84c" stroke-width="1.4" fill="none" stroke-linecap="round"/>
                </svg>
            </div>
            <h4>Porsche</h4>
            <small>Records System</small>
        </div>

        @if($errors->any())
        <div class="alert alert-danger py-2 mb-3" style="font-size:0.85rem;">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember" style="font-size:0.85rem;">Remember me</label>
            </div>
            <button type="submit" class="btn btn-porsche w-100 py-2">Sign In</button>
        </form>

        <hr class="my-3">
        <p class="text-center mb-0" style="font-size:0.85rem;">
            Don't have an account? <a href="{{ route('register') }}" style="color:var(--porsche-red);font-weight:600;">Register</a>
        </p>
    </div>
</div>
@endsection
