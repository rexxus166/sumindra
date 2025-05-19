<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Tambahkan import ini
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

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
        // Kirim cartCount ke seluruh view
        View::composer('*', function ($view) {
            $cartCount = Auth::check() ? Cart::where('user_id', Auth::id())->sum('quantity') : 0;
            $view->with('cartCount', $cartCount);
        });
    }
}
