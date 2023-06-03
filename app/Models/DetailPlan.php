<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailPlan extends Model
{
    protected $table = 'detail_plans';
    protected $fillable = ['name'];

    public function plan(){
        return $this->BelongsTo(Plan::class);
    }
}
