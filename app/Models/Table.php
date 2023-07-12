<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use TenantTrait;
    protected $fillable= ['identify', 'desciption', 'tenant_id'];

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }
}
