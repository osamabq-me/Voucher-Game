<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SetPasswordController extends Controller
{
    public function showSetPasswordForm(Request $request)
    {
        return view('auth.set-password', $request->all());
    }

    public function setPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::updateOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'username' => $request->username,
                'github_id' => $request->github_id,
                'github_name' => $request->github_name,
                'github_username' => $request->github_username,
                'github_token' => $request->github_token,
                'github_refresh_token' => $request->github_refresh_token,
                'password' => Hash::make($request->password),
            ]
        );

        Auth::login($user, true);

        return redirect()->route('welcome')->with('status', 'Password set successfully.');
    }
}
