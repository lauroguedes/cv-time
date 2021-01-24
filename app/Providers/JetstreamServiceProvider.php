<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);

        //Auth with blade
        Fortify::loginView(function () {
            return view('auth/login', [
                'canResetPassword' => Route::has('password.request'),
                'status' => session('status'),
            ]);
        });
        
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth/forgot-password', [
                'status' => session('status'),
            ]);
        });
        
        Fortify::resetPasswordView(function (Request $request) {
            return view('auth/reset-password', [
                'email' => $request->input('email'),
                'token' => $request->route('token'),
            ]);
        });
        
        Fortify::registerView(function () {
            return view('auth/register');
        });
        
        Fortify::verifyEmailView(function () {
            return view('auth/verify-email', [
                'status' => session('status'),
            ]);
        });
        
        Fortify::twoFactorChallengeView(function () {
            return view('auth/two-factor-challenge');
        });
        
        Fortify::confirmPasswordView(function () {
            return view('auth/confirm-password');
        });
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
