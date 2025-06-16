<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
    public function boot()
    {
        Blade::directive('statusBadge', function ($status) {
            return "<?php 
                \$classes = [
                    'pending' => 'bg-yellow-100 text-yellow-800',
                    'approved' => 'bg-green-100 text-green-800',
                    'rejected' => 'bg-red-100 text-red-800',
                    'changes_requested' => 'bg-blue-100 text-blue-800',
                ][{$status}];
                echo '<span class=\"px-2 py-1 text-xs font-semibold rounded-full '.\$classes.'\">'.ucfirst({$status}).'</span>';
            ?>";
        });
    }
}
