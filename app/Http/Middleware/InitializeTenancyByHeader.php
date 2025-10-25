<?php

namespace App\Http\Middleware;

use Closure;
use Stancl\Tenancy\Tenancy;
use Symfony\Component\HttpFoundation\Response;

class InitializeTenancyByHeader
{
    public function handle($request, Closure $next): Response
    {
        $tenantId = $request->header('X-Tenant');

        if (! $tenantId) {
            return response()->json(['message' => 'Tenant header missing'], 400);
        }

        $tenancy = app(Tenancy::class);

        try {
            $tenancy->initialize($tenantId);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Invalid tenant: ' . $tenantId], 404);
        }

        $response = $next($request);

        $tenancy->end();

        return $response;
    }
}
