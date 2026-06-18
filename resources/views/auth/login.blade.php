<x-guest-layout subtitle="Log in to your account">
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" style="display:block;font-size:12.5px;font-weight:500;color:#334155;margin-bottom:5px;">Email address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                   placeholder="name@company.com"
                   class="auth-input"
                   style="display:block;width:100%;padding:10px 14px;border:1px solid #e2e6ef;border-radius:10px;font-size:13.5px;background:#fafbfc;color:#0f172a;outline:none;box-sizing:border-box;transition:border-color 0.15s,box-shadow 0.15s;">
            @error('email')
                <p style="font-size:12px;color:#dc2626;margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="margin-top:18px;">
            <label for="password" style="display:block;font-size:12.5px;font-weight:500;color:#334155;margin-bottom:5px;">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   placeholder="Enter your password"
                   class="auth-input"
                   style="display:block;width:100%;padding:10px 14px;border:1px solid #e2e6ef;border-radius:10px;font-size:13.5px;background:#fafbfc;color:#0f172a;outline:none;box-sizing:border-box;transition:border-color 0.15s,box-shadow 0.15s;">
            @error('password')
                <p style="font-size:12px;color:#dc2626;margin-top:4px;">{{ $message }}</p>
            @enderror
        </div>

        <div style="display:flex;align-items:center;justify-content:space-between;margin-top:16px;">
            <label style="display:flex;align-items:center;gap:7px;cursor:pointer;">
                <input type="checkbox" name="remember" style="accent-color:#2563EB;width:15px;height:15px;">
                <span style="font-size:13px;color:#475569;">Remember me</span>
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:13px;color:#2563EB;text-decoration:none;font-style:italic;">Forgot password?</a>
            @endif
        </div>

        <button type="submit" style="width:100%;padding:12px;background:#2563EB;color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:500;cursor:pointer;margin-top:22px;transition:background 0.15s;"
                onmouseover="this.style.background='#1d4ed8'" onmouseout="this.style.background='#2563EB'">Log in</button>

        <div style="display:flex;align-items:center;gap:12px;margin-top:22px;">
            <hr style="flex:1;border:none;border-top:1px solid #e2e6ef;">
            <span style="font-size:12px;color:#94a3b8;font-style:italic;white-space:nowrap;">or continue with</span>
            <hr style="flex:1;border:none;border-top:1px solid #e2e6ef;">
        </div>

        <a href="#" style="display:flex;align-items:center;justify-content:center;gap:10px;width:100%;padding:11px;background:#fff;border:1px solid #e2e6ef;border-radius:10px;font-size:13px;color:#0f172a;text-decoration:none;margin-top:16px;cursor:pointer;transition:background 0.15s;box-sizing:border-box;"
           onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='#fff'">
            <svg width="18" height="18" viewBox="0 0 48 48">
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                <path fill="#FBBC05" d="M10.53 28.59A14.5 14.5 0 019.5 24c0-1.59.28-3.14.76-4.59l-7.98-6.19A23.99 23.99 0 000 24c0 3.77.87 7.35 2.56 10.56l7.97-5.97z"/>
                <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 5.97C6.51 42.62 14.62 48 24 48z"/>
            </svg>
            Continue with Google
        </a>

        <p style="text-align:center;font-size:13px;color:#64748b;margin-top:20px;">
            Don't have an account?
            <a href="{{ route('register') }}" style="color:#2563EB;text-decoration:none;font-style:italic;">Sign up</a>
        </p>
    </form>
</x-guest-layout>
