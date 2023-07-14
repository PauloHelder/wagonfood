<?php

namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTableByTenantUuid(string $uuid);
    public function getTableByTenantid(int $id);
}