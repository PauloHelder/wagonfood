<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Services\TenantService;
use Illuminate\Http\Request;

class TenantApiController extends Controller
{
    protected $tenantService;
    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    public function index()
    {
        return TenantResource::collection($this->tenantService->getAllTenants());
    }
    public function show(string $uuid)
    {
        if(!$tenant = $this->tenantService->getTenantsByUuid($uuid))
        {
            return response()->json(['message','Não esncontrado']);
        }

        return new TenantResource($tenant);
    }
}
