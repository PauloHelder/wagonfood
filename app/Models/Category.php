<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use TenantTrait;
    protected $fillable = ['name','url', 'description', 'tenant_id'];

    public function tenant(){
        return $this->BelongsTo(Tenant::class);
    }

    public function product(){
        return $this->belongsToMany(Product::class);
    }
}
