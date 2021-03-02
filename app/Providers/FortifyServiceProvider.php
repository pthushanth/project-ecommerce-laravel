<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use SebastianBergmann\Environment\Console;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
            // dd(Session::has('adminLoginPage'));

            // if (Session::has('adminLoginPage')) {

            //     Session::forget('adminLoginPage');
            //     return view('admin.auth.login');
            // } else
            return view('auth.login');
        });

        Fortify::registerView(function () {
            // if (Session::has('adminRegisterPage')) {
            //     Session::forget('adminRegisterPage');
            //     return view('admin.auth.register');
            // } else
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.password.email');
        });

        Fortify::resetPasswordView(function () {
            return view('auth.password.reset');
        });
    }
}
