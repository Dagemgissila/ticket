<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExceptionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->make('Illuminate\Contracts\Debug\ExceptionHandler')
            ->renderable(function (AuthorizationException $e, Request $request) {
                if ($request->wantsJson() || $request->is('api/*')) {
                    return new JsonResponse([
                        'message' => 'This action is unauthorized.',
                    ], 403);
                }
            });
    }

    public function register()
    {
        //
    }
}