<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    protected $plan, $profile;
     public function __construct(Plan $plan, Profile $profile)
     {
        $this->plan     = $plan;
        $this->profile   = $profile;
     }

     /**
     * Plans dos Profiles
     */
    public function profiles($idPlan)
    {
        $plan= $this->plan->find($idPlan);
        if(!$idPlan)
            return redirect()->back()->with('error', 'Plano não encontrado');
        
        $profiles = $plan->profiles()->paginate();
        
        return view('admin.pages.plans.profiles.profiles', compact('plan', 'profiles'));
    }

    public function profilesAvailable(Request $request, $idPlan)
    {
        $plan = $this->plan->find($idPlan);
        if(!$plan)
            return redirect()->back()->with('error', 'Plano não encontrado');
        
        $filters = $request->except('_token');
        $profiles = $plan->profilesAvailable($request->filter);

        return view('admin.pages.plans.profiles.available', compact('plan', 'profiles', 'filters'));
    }

    public function attachProfilesPlan(Request $request, $idPlan)
    {   
        $plan = $this->plan->find($idPlan);
        if(!$plan)
            return redirect()->back()->with('error', 'Plano não encontrado');
        
        if(!$request->profiles || count($request->profiles) == 0)
            return redirect()->back()->with('alert', 'Selecione ao menos uma Perfil');
            
        $plan->profiles()->attach($request->profiles);
        return redirect()
                    ->route('plans.profiles',$idPlan)
                    ->with('message','Perfil adicionadas cao Plano');


    }
    
    public function detachProfilesPlan($idPlan,$idProfile)
    {   
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if(!$plan || !$profile)
            return redirect()->back()->with('error', 'Plano não encontrado');
        
        $plan->profiles()->detach($profile);
        return redirect()
                    ->route('plans.profiles',$idPlan)
                    ->with('message','Perfil removido cao Plano');


    }

     /**
     * Plans dos Profiles
     */
    public function plans($idprofile)
    {
        $profile= $this->profile->find($idprofile);
        if(!$profile)
            return redirect()->back()->with('error', 'Perfil não encontrado');
        
        $plans = $profile->plans()->paginate();
        
        return view('admin.pages.profiles.plans.plans', compact('plans', 'profile'));
    }

    public function plansAvailable(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile)
            return redirect()->back()->with('error', 'PErfil não encontrado');
        
        $filters = $request->except('_token');
        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plans.available', compact('plans', 'profile', 'filters'));
    }

    public function attachPlansProfile(Request $request, $idProfile)
    {   
        $profile = $this->profile->find($idProfile);
        if(!$profile)
            return redirect()->back()->with('error', 'Perfil não encontrado');
        
        if(!$request->plans || count($request->plans) == 0)
            return redirect()->back()->with('alert', 'Selecione ao menos uma Perfil');
            
        $profile->plans()->attach($request->plans);
        return redirect()
                    ->route('profiles.plans',$idProfile)
                    ->with('message','Plano adicionado ao Perfil');
    }
    
    public function detachPlansProfile($idProfile,$idPlan)
    {   
        $plan = $this->plan->find($idPlan);
        $profile = $this->profile->find($idProfile);

        if(!$plan || !$profile)
            return redirect()->back()->with('error', 'Perfil não encontrado');
        
        $profile->plans()->detach($plan);
        return redirect()
                    ->route('profiles.plans',$idProfile)
                    ->with('info','Plano removido do Perfil');

    }


}
