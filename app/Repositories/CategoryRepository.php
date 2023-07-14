<?php

namespace App\Repositories;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $table;

    public function __construct() 
    {
        $this->table = 'categories';
    }

    public function getCategoryByTenantUuid(string $uuid)
    {
       return DB::table($this->table) 
            ->join('tenants','tenants.id','=', 'category.tenant_id')
            ->where('tenant.uuid',$uuid)
            ->select('*')
            ->get();
    }

    public function getCategoryByTenantid(int $idTenant)
    {
       return DB::table($this->table)->where('tenant_id',$idTenant)->get();
    }
}