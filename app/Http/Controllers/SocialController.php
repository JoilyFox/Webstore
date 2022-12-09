<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Traits\HasRoles;

class SocialController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
        
    }
    

    public function loginWithGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $isUser = User::where('google_id', $user->id)->first();

            if ($isUser) {
                Auth::login($isUser);
                
                return redirect(route('homeAdmin'));
            } else {
                $createUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('user'),
                ]);

                Auth::login($createUser);

                return redirect('/');
            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
}
