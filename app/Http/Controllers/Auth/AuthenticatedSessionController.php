<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function admin_create(): View
    {
        return view('auth.admin_login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        
        if (!auth()->user()->hasRole("employee") || !auth()->user()->employee->isValidated){
            $this->destroy($request);
            return back()->withErrors(["email" => "These credentials doesn't match our records. Please contact your administrator if you think your credentials are correct."]);
        }

        $request->session()->regenerate();
        return redirect()->intended(route("dashboard", absolute: false));
    }

    public function admin_store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if (!auth()->user()->hasRole("admin")){
            $this->destroy($request);
            return back()->withErrors(["email" => "These credentials doesn't match our records."]);
        }

        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard', absolute: false));
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
