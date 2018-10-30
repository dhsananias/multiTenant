<?php

namespace App\Traits\Controllers;

use Illuminate\Http\Request;

trait subDomain
{

    public static function getSubDomain($domain)
    {
        // $domain = $request->getDomain();
        $domainExploded = explode('.', $domain);

        return $domainExploded[0];
    }

}