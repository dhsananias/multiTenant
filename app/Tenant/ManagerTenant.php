<?php 

namespace App\Tenant;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Traits\Controllers\subDomain;

class ManagerTenant
{
    use subDomain;

    public function setConnection(Company $company)
    {

        DB::purge('tenant');

        config()->set('database.connections.tenant.host', $company->ip);
        config()->set('database.connections.tenant.database', $company->nome_banco);
        config()->set('database.connections.tenant.username', $company->usuario_banco);
        config()->set('database.connections.tenant.schema', $company->squema);
        config()->set('database.connections.tenant.password', $company->senha_banco);

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();

    }

    public function domainIsMain(Request $request)
    {   
        // dd();
        $domain = $request->getHost();
        return subDomain::getSubDomain($domain) == config('tenant.domain_main');

    }

}