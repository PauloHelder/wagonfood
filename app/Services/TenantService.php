<?php

namespace App\Services;
use Illuminate\Support\Str;
use App\Models\Plan;

class TenantService
{
    private  $plan, $data;

    public function make(Plan $plan, $data){
        $this->plan = $plan;
        $this->data = $data;

        if(!$this->plan){
            return redirect()->route('site.home')->with('message','por favor escolha um tema');
        }

        $tenant = $this->storeTenant(); 
        $user = $this->storeUser($tenant) ;

        return $user;
        
    }

    public function storeTenant(){

        return $this->plan->tenants()->create([
            'name'  => $this->data['empresa'],
            'nif'  => $this->data['nif'],
            'email' => $this->data['email'],

            'subscription' => now(),
            'expire_at' => now()->addDays(7),
        ]);
    }

    public function storeUser($tenant){

        return $tenant->users()->create([
            'name' => $this->data['name'],
            'email' => $this->data['email'],
            'password' => bcrypt($this->data['password']),
            //'password' => Hash::make($data['password']),
        ]);


    }
}