<?php

namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class TableService
{
    protected $tableRepository,$tenantRepository ;
    public function __construct(
        TableRepositoryInterface $tableRepository,
        TenantRepositoryInterface $tenantRepository
        )
    {
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
    }

    public function getTableByUuid(string $uuid)
    {

        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->tableRepository->getTableByTenantid($tenant->id);
    }
}