<x-guest-layout>
    <div class="register-container" style="max-width:400px; margin:48px auto; background:#fff; border-radius:16px; box-shadow:0 2px 16px rgba(0,0,0,0.12); padding:32px 28px; position:relative;">
        <div style="text-align:center; margin-bottom:18px;">
        </div>
        <div class="register-title" style="font-size:1.5rem; font-weight:bold; color:#4e3b31; text-align:center; margin-bottom:18px;">Daftar Akun</div>
        <form method="POST" action="{{ route('register') }}" style="display:flex; flex-direction:column; gap:14px;">
            @csrf
            <label for="name" style="font-weight:500;">Nama</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus style="border-radius:6px; border:1px solid #c69c6d; padding:8px;">
            @error('name')
                <div class="invalid-feedback" style="color:#a3342f; font-size:0.95rem;">{{ $message }}</div>
            @enderror

            <label for="email" style="font-weight:500;">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required style="border-radius:6px; border:1px solid #c69c6d; padding:8px;">
            @error('email')
                <div class="invalid-feedback" style="color:#a3342f; font-size:0.95rem;">{{ $message }}</div>
            @enderror

            <label for="password" style="font-weight:500;">Password</label>
            <input id="password" type="password" name="password" required style="border-radius:6px; border:1px solid #c69c6d; padding:8px;">
            @error('password')
                <div class="invalid-feedback" style="color:#a3342f; font-size:0.95rem;">{{ $message }}</div>
            @enderror

            <label for="password_confirmation" style="font-weight:500;">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required style="border-radius:6px; border:1px solid #c69c6d; padding:8px;">

            <button type="submit" style="background:#c69c6d; color:#fff; border:none; border-radius:6px; padding:10px 24px; font-weight:bold; margin-top:8px;">Register</button>
        </form>
        <div style="text-align:center; margin-top:18px;">
            <span>Sudah punya akun?</span>
            <a href="{{ route('login') }}" style="color:#c69c6d; font-weight:bold; text-decoration:underline;">Login</a>
        </div>
    </div>
</x-guest-layout>
