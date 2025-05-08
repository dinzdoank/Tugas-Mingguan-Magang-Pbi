<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-title">Login</div>
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div style="margin-bottom: 16px;">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Remember me</label>
        </div>

        <button type="submit">Log in</button>
    </form>

    <div style="text-align:center; margin-top:18px;">
        <span>Belum punya akun?</span>
        <a href="{{ route('register') }}" style="color:#c69c6d; font-weight:bold; text-decoration:underline;">Daftar Sekarang</a>
    </div>
</x-guest-layout>
