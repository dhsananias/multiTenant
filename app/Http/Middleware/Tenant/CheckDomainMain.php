<?php

namespace App\Http\Middleware\Tenant;

use Closure;

class CheckDomainMain
{
    public function handle($request, Closure $next)
    {   
        // if (request()->getHost() != config('tenant.domain_main')) {
        //     abort(401);
        // }

        return $next($request);
    }
}
