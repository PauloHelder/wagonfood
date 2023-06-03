<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;


class PlanController extends Controller
{
    private $repository;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan; 
    }
    public function index(){
        $plans = $this->repository
                        ->with('details')
                        ->latest()
                        ->paginate(10);
        
        return view('admin.pages.plans.index',[ 
           "plans" => $plans, 
        ]);
    }

    public function create(){
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request){
        $this->repository->create($request->all());

        return redirect()
                    ->route('plans.index')
                    ->with('message','Plano Criado com sucesso');
    }

    public function show($url){
       $plan =  $this->repository->where('url',$url)->first();
        if(!$plan)
            redirect()->back();

       return view('admin.pages.plans.show',['plan'=>$plan]);
    }

    public function destroy($url){
        $plan =  $this->repository
                        ->with('details')
                        ->where('url',$url)
                        ->first();
         if(!$plan)
             redirect()->back();
        
        if($plan->details->count() > 0)
            return redirect()
                        ->back()
                        ->with('error','Deve remover os detalhes, antes de deletar um plano');
        $plan->delete();
        return redirect()
                    ->route('plans.index')
                    ->with('message','Plano Deletado com sucesso');;
     }

     public function search(Request $request){
        $filters = $request->except('_token');
        $plans =  $this->repository->search($request->filter);
        
      return view('admin.pages.plans.index', [
        'plans' => $plans,
        'filters' => $filters,
      ]);
         
    }
    
    public function edit($url){
       $plan =  $this->repository->where('url',$url)->first();
         if(!$plan)
             redirect()->back();
        return view('admin.pages.plans.edit',['plan' => $plan]);
     }

     public function Update(StoreUpdatePlan $request, $url){
        $plan =  $this->repository->where('url',$url)->first();
        if(!$plan)
            redirect()->back();
      
        $plan->update($request->all());

        return redirect()
                    ->route('plans.index')
                    ->with('message','Plano Actualizado com sucesso');;
     }
       

    

}
