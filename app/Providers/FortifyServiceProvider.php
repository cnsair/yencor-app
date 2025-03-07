<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User; // ✅ Import User Model

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ✅ Block Deactivated, Suspended, or Banned users from logging in
        Fortify::authenticateUsing(function ($request) {
            $user = User::where('email', $request->email)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                if (in_array($user->status, [2, 3, 4])) { 
                    return null; // ❌ Block login if Deactivated (2), Suspended (3), or Banned (4)
                }
                return $user; // ✅ Allow login only if Active (1)
            }

            return null; // ❌ Block invalid login attempts
        });
        // ✅ Block Deactivated, Suspended, or Banned users from logging in
     //   Fortify::authenticateUsing(function ($request) {
       //     $user = User::where('email', $request->email)->first();
//
  //          if ($user && Hash::check($request->password, $user->password)) {
    //            if ($user->status == 2) { // Deactivated
      //              return null; // Block login
        //        } elseif ($user->status == 3) { // Suspended
         //           return null; // Block login
           //     } elseif ($user->status == 4) { // Banned
             //       return null; // Block login
               // }
               // return $user; // Allow login for active users
            //}

            //return null; // Block invalid users
        //});

        // ✅ Fortify default methods
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        // ✅ Rate Limiting
        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
