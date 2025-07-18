<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()                             
    {
     return Socialite::driver('google')
        ->with(['prompt' => 'select_account consent']) // 👈 Add this line here
        ->redirect();
}
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'password' => bcrypt('defaultpassword'),
                'google_id' => $googleUser->getId(),
            ]
        );

        Auth::login($user);
        return redirect()->route('employee'); // or dashboard
    }
}

