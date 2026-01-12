<?php

namespace App\Http\Controllers\Auth\Executive;

use App\Models\Executive;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
    public function create(): View
    {
        return view('auth.executive_register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Executive::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $executive = Executive::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('executive')->login($executive);

        return redirect(RouteServiceProvider::EXECUTIVE_DASHBOARD);
    }
}