<?php

namespace App\Repositories;

use App\Repositories\Contracts\TableRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TableRepository implements TableRepositoryInterface
{
    protected $table;

    public function __construct() 
    {
        $this->table = 'tables';
    }

    public function getTableByTenantUuid(string $uuid)
    {
       return DB::table($this->table) 
            ->join('tenants','tenants.id','=', 'table.tenant_id')
            ->where('tenant.uuid',$uuid)
            ->select('*')
            ->get();
    }

    public function getTableByTenantid(int $idTenant)
    {
       return DB::table($this->table)->where('tenant_id',$idTenant)->get();
    }
}