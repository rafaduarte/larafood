<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class plan extends Model
{
    //
    protected $fillable = ['name', 'price', 'description'];

    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }

    /**
     *  Get Profiles
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function search($filter = null)
    {   
        // %% para pesquisa tanto no inicio quanto no final
        $results = $this->where('name', 'LIKE', "%{$filter}%")
                    ->orWhere('description', 'LIKE', "%{$filter}%")
                    ->paginate();
                // get para retornar todos os dados
                return $results;
    }

    /**
     * Profiles not liked with this profile
     */
    public function profilesAvailable($filter = null)
    {
        $profiles = Profile::whereNotIn('id', function($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id={$this->id}");
        })
        ->where(function ($queryFilter) use ($filter){
            if ($filter)
                $queryFilter->where('profiles.name', 'LIKE', "%{$filter}%");
        })
        ->paginate();

        return $profiles;
    }
}
