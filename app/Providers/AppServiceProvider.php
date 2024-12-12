<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Blade;

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
        Paginator::useBootstrap();
  
        Blade::directive('eccho', function ($string) {
            return "<?php echo 'echo: ' . ($string); ?>";
        });
        
        Blade::directive('datetime', function ($expression) {
            return "<?php 
                if ($expression) {
                    echo Carbon\Carbon::parse($expression)->translatedFormat('j F Y, H:i '); 
                } else {
                    echo ' ';
                }
            ?>";
            
        });
    }
}
