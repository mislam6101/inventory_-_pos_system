<?php

namespace App\Http\Controllers\Auth\Manager;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Manager;
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check credentials first
        if (Auth::guard('manager')->validate([
            'email' => $request->email,
            'password' => $request->password,
        ])) {

            $manager = Manager::where('email', $request->email)->first();

            // Inactive account → block + flash message
            if ($manager->status == 0) {
                return back()->with('inactive', true);
            }

            // Active → login
            Auth::guard('manager')->login($manager);

            return redirect()->intended(RouteServiceProvider::MANAGER_DASHBOARD);
        }

        return back()
            ->withInput()
            ->with('error', 'Email or Password is incorrect.');
    }


    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('manager')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
