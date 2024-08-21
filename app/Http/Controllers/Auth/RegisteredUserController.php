<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dzongkhag;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $dzongkhags = Dzongkhag::all();
        return view('auth.register', compact('dzongkhags'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'cid' => ['required', 'string', 'max: 11', 'unique:'.User::class, 'regex:/^[1-3]/'],
            'phone_number' => 'required|string|max:8', 
            'dzongcode' => 'required|exists:dzongkhags,dzongcode',
            'gewocode' => 'required|exists:gewogs,gewogcode',
            'villcode' => 'required|exists:villages,villcode',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cid' => $request->cid,
            'phone_number' => $request->phone_number,
            'dzongcode' => $request->dzongcode,
            'gewocode' => $request->gewocode,
            'villcode' => $request->villcode,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('user');

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
