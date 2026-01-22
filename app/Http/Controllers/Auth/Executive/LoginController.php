<?php

namespace App\Http\Controllers\Auth\Executive;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Executive;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create(): View
    {
        return view('auth.executive_login');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check credentials first
        if (Auth::guard('executive')->validate([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            $executive = Executive::where('email', $request->email)->first();

            // Inactive account → block + flash message
            if ($executive->status == 0) {
                return back()->with('inactive', true);
            }

            // Active → login
            Auth::guard('executive')->login($executive);

            return redirect()->intended(RouteServiceProvider::EXECUTIVE_DASHBOARD);
        }

        return back()
            ->withInput()
            ->with('error', 'Email or Password is incorrect.');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('executive')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}