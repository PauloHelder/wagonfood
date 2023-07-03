<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use TenantTrait;
    protected $fillable = ['titulo','image','flag','price', 'description', 'tenant_id','uuid'];

    public function category(){
        return $this->belongsToMany(Category::class);
    }

}