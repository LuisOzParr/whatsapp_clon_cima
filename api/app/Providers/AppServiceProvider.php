<?php

namespace App\Providers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Response;

class AppServiceProvider extends ServiceProvider
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
        Response::macro('success', function ($data, int $status = 200) : JsonResponse {
            return Response::json($data, $status);
        });

        Response::macro('error', function ($message, int $status) : JsonResponse {
            return Response::json(['message' => $message, 'code' => $status], $status);
        });
    }
}
