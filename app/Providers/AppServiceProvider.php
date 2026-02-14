<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        //
        Paginator::useBootstrapFour();
        //
        Gate::define('isAdmin', function ($user) {
             $user = User::join('roles', 'roles.id', 'users.role_id')->where('users.is_deleted', 'N')
    ->where('users.id', Auth::user()->id)->select('roles.slug')->first();
            return $user->slug == 'admin';
        });
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
});
}
}
