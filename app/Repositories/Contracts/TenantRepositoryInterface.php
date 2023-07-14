<?php

namespace App\Repositories\Contracts;

interface TenantRepositoryInterface
{
    public function getAllTenant();
    public function getTenantByUuid(string $uuid);
}