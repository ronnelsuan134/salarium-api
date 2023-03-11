<?php

namespace App\Providers;

use App\Services\AuditTrailLogService;
use Illuminate\Support\Facades\Event;
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
        Event::listen('eloquent.updated:*', function ($event, $payload) {
            AuditTrailLogService::logAuditTrail('updated', $payload[0]);
        });
    }
}
