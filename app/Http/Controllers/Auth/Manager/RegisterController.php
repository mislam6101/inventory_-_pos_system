<?php

namespace App\Http\Controllers\Auth\Manager;

use App\Models\Manager;
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
        return view('auth.manager_register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Manager::class],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $manager = Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('manager')->login($manager);

        return redirect(RouteServiceProvider::MANAGER_DASHBOARD);
    }
}