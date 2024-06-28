<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return RedirectResponse
     */
    public function redirectToProvider(): RedirectResponse
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return RedirectResponse|View
     */
    public function handleProviderCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors('Error authenticating with GitHub.');
        }

        if (Auth::check()) {
            // User is logged in
            $user = Auth::user();

            if (User::where('github_id', $githubUser->id)->exists() && $user->github_id != $githubUser->id) {
                return redirect()->route('profile.edit')->with('error', 'This GitHub account is already linked with another account.');
            }

            $user-> update ([
                'github_id' => $githubUser->id,
                'github_name' => $githubUser->name ?? $githubUser->nickname,
                'github_username' => $githubUser->nickname,
                'github_token' => $githubUser->token,
                'github_refresh_token' => $githubUser->refreshToken,
            ]);

            return redirect()->route('profile.edit')->with('success', 'GitHub account connected.');
        } else {
            // User is not logged in
            $user = User::where('github_id', $githubUser->id)->orWhere('email', $githubUser->email)->first();

            if ($user) {
                $user->update([
                    'github_id' => $githubUser->id,
                    'github_name' => $githubUser->name ?? $githubUser->nickname,
                    'github_username' => $githubUser->nickname,
                    'github_token' => $githubUser->token,
                    'github_refresh_token' => $githubUser->refreshToken,
                ]);
                Auth::login($user, true);
                return redirect()->route('welcome')->with('success', 'Logged in with GitHub.');
            } else {
                return view('auth.set-password', [
                    'name' => $githubUser->name,
                    'email' => $githubUser->email,
                    'username' => $githubUser->nickname,
                    'github_id' => $githubUser->id,
                    'github_name' => $githubUser->name ?? $githubUser->nickname,
                    'github_username' => $githubUser->nickname,
                    'github_token' => $githubUser->token,
                    'github_refresh_token' => $githubUser->refreshToken,
                ]);
            }
        }
    }
}
