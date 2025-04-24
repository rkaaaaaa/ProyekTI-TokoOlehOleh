<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware  = [
        'auth' => \App\Http\Middleware\AuthenticateUser::class,
        'superadmin' => \App\Http\Middleware\SuperAdminMiddleware::class,
    ];
}
