<?php

namespace App\Actions\Fortify;

use App\Models\Customer;
use App\Models\User;
use App\Notifications\NewClientNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        //ADMIN 
        if (Route::currentRouteName() == "admin.register") {
            Validator::make($input, [
                'name' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
            ])->validate();
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);
            //$user->notify(new NewClientNotification($user));
            // User::getAdmins()->notify(new NewClientNotification($user));
            // Send the notifications
        }

        // Customer create
        else {


            Validator::make($input, [
                'title' => ['required'],
                'lastname' => ['required', 'string', 'max:255'],
                'firstname' => ['required', 'string', 'max:255'],
                'email' => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique(User::class),
                ],
                'password' => $this->passwordRules(),
            ])->validate();

            $user = User::create([
                'name' => $input['firstname'] . ' ' . $input['lastname'],
                'email' => $input['email'],
                'role' => 'client',
                'password' => Hash::make($input['password']),
            ]);
            $user->customer()->create([
                'title' => $input['title'],
                'lastname' => $input['lastname'],
                'firstname' => $input['firstname']
            ]);
            Notification::send(User::getAdmins(), new NewClientNotification($user));
            return $user;
        }
    }
}
