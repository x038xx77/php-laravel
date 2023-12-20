<?php
// app/Http/Middleware/DisableCORS.php

namespace App\Http\Middleware;

use Closure;

class DisableCORS
{
    public function handle($request, Closure $next)
    {
        // Разрешите доступ к вашему API с любого источника
        return $next($request)->header('Access-Control-Allow-Origin', '*');
    }
}
