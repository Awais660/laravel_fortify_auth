<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Actions\Fortify\CreateNewAdmin;
use App\Actions\Fortify\ResetAdminPassword;
use App\Actions\Fortify\UpdateAdminPassword;
use App\Actions\Fortify\UpdateAdminProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if(request()->is('admin/*')){
            config()->set('fortify.guard','admin');
            config()->set('fortify.home','/admin/home');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if(request()->is('admin/*')){
        Fortify::createUsersUsing(CreateNewAdmin::class);
        Fortify::updateUserProfileInformationUsing(UpdateAdminProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateAdminPassword::class);
        Fortify::resetUserPasswordsUsing(ResetAdminPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function(){
            return view('admin.login');
        });

        Fortify::registerView(function(){
            return view('admin.register');
        });

        Fortify::requestPasswordResetLinkView(function(){
            return view('admin.forgot-password');
        });

        Fortify::resetPasswordView(function($request){
            return view('admin.reset-password', ['request' => $request]);
        });

        Fortify::confirmPasswordView(function(){
            return view('admin.password-confirm');
        });
    }else{
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::loginView(function(){
            return view('auth.login');
        });

        Fortify::registerView(function(){
            return view('auth.register');
        });

        Fortify::requestPasswordResetLinkView(function(){
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function($request){
            return view('auth.reset-password', ['request' => $request]);
        });

        Fortify::verifyEmailView(function(){
            return view('auth.verify-email');
        });

        Fortify::confirmPasswordView(function(){
            return view('auth.password-confirm');
        });

        Fortify::twoFactorChallengeView(function(){
            return view('auth.two-factor-challenge');
        });
    }
}
}
