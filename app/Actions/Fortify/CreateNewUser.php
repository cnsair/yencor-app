<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Http;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'role' => ['required', 'integer'],
            'firstname' => ['required', 'string', 'regex:/^[\p{L}\p{N}@_.-]*$/u', 'max:30'],
            'lastname' => ['required', 'string', 'regex:/^[\p{L}\p{N}@_.-]*$/u', 'max:30'],
            'phone' => ['required', 'string', 'max:25', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:40', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
           'g-recaptcha-response' => ['required', function ($attribute, $value, $fail) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $value,
                    'remoteip' => request()->ip(),
                ])->json();

                if (!$response['success']) {
                    $fail('reCAPTCHA verification failed.');
                }
            }],
        ])->validate();

        // $yenkor_id = hexdec(uniqid());
        $yenkor_id = random_int(10, 99) . time();
        //$yenkor_id = mt_rand(1000000, 9999999);

        if ( $input['role'] == 0 ) {
            $is_rider = 1; 
            $status = 4; 
        }else{
            $is_rider = 0; 
            $status = 3;
        }

        if ( $input['role'] == 1 ) {
            $is_driver = 1; 
        }else{
            $is_driver = 0; 
        }
        
        return User::create([
            'role' => $input['role'],
            'yenkor_id' => $yenkor_id,
            'status' => $status,
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'is_rider' => $is_rider,
            'is_driver' => $is_driver,
            'password' => Hash::make($input['password']),
        ]);
    }
}
