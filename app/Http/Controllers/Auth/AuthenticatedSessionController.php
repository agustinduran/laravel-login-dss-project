<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthenticatedSessionController extends Controller
{

    // Agrega el método para manejar los intentos fallidos
    protected function throttleKey(Request $request)
    {
        return Str::lower($request->input('email')).'|'.$request->ip();
    }

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $maxAttempts = 2;
        $decayMinutes = 1;

        // Verificar si hay demasiados intentos fallidos
        if (RateLimiter::tooManyAttempts($this->throttleKey($request), $maxAttempts)) {
            event(new Lockout($request));

            $seconds = RateLimiter::availableIn($this->throttleKey($request));
            throw ValidationException::withMessages([
                'email' => __('Demasiados intentos de inicio de sesión. Por favor, inténtalo de nuevo en :seconds segundos.', ['seconds' => $seconds]),
            ]);
        }

        // Incrementar el conteo de intentos
        RateLimiter::hit($this->throttleKey($request), $decayMinutes * 60);

        // Autenticar al usuario
        $request->authenticate();
        $request->session()->regenerate();

        RateLimiter::clear($this->throttleKey($request));

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
