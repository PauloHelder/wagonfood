<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profile extends Model
{
    protected $table = 'profiles';
    protected $fillable = [
        'name',
        'description',
    ];
    /**
     * Get Permissions
     */
    public function plans(){
        return $this->BelongsToMany(Plan::class);
    }
    public function plansAvailable($filter = null){
        
        $plans = Plan::whereNotIn('plans.id', function($query){
            $query->select('plan_profile.plan_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.profile_id={$this->id}");
        })
        ->where(function($queryFilter) use($filter){
            if($filter)
                $queryFilter->where('plans.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();
        return $plans;
    }

}
