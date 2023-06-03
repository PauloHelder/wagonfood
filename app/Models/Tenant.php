<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'Tenants';
    protected $fillable = [
        'name','url','uuid','email','nif','logo','active',
        'subscription','expire_at', 'subscription_id',
        'subscription_active','subscription_suspend',
    ];

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

   
}
