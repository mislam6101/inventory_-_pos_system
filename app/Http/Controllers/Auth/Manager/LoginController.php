<?php

namespace App\Http\Controllers\Auth\Manager;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.manager_login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if(! Auth::guard('manager')->attempt($request->only('email', 'password'), $request->boolean('remember')))
        {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::MANAGER_DASHBOARD);
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('manager')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/manager/login');
    }
}