<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetTurbolinksHeader
{

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->header('Turbolinks-Location', $request->url());

        return $response;
    }
}