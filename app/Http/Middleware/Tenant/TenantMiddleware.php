<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use App\Models\Company;
use Closure;
use Illuminate\Http\Request;
use App\Traits\Controllers\subDomain;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TenantMiddleware
{
    use subDomain;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $manager = app(ManagerTenant::class);
        $requisicao = app(Request::class);
        // dd($requisicao);

        $company = $this->getCompany($request->getHost());
        // dd($company);
        if (!$company && $request->url() != route('404.tenant')){
        
            return redirect()->route('404.tenant');
        
        } else if ($request->url() != route('404.tenant') && !$manager->domainIsMain($requisicao)) {
        
            $manager->setConnection($company);
        
        }

    //    dd(DB::connection()->getDatabaseName());
       
                
        return $next($requisicao);
    }

    public function getCompany($host)
    {
        $subdomain = subdomain::getSubDomain($host);
        // dd($subdomain);
        // dd(Company::where('nomecliente', "{$subdomain}")->first());

        return Company::where('nomecliente', $subdomain)->first();

    }
}
