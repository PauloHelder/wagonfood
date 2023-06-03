<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table    = 'permissions';
    protected $fillable = ['name','description'];

    /**
     * Get Profile
     */
    public function profiles(){
        return $this->BelongsToMany(Profile::class);
    }

    public function profilesAvailable($filter = null){
        
        $permissions = Profile::whereNotIn('profiles.id', function($query){
            $query->select('permission_profile.profile_id');
            $query->from('permission_profile');
            $query->whereRaw("permission_profile.permission_id={$this->id}");
        })
        ->where(function($queryFilter) use($filter){
            if($filter)
                $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();
        return $permissions;
    }
}
