<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\Plan;
use App\Models\DetailPlan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
      protected $repository, $plan;

     public function __construct(DetailPlan $detailPlans, Plan $plan){
        $this->repository   = $detailPlans;
        $this->plan         = $plan;
     }

     public function index($urlPlan){
        if(!$plan = $this->plan->where('url',$urlPlan)->first()){
            return redirect()->back();
        }

        $details = $plan->details()->paginate();

        return view('admin.pages.plans.details.index',[
            'plan'      => $plan,
            'details'   => $details,
        ]);
     }

     public function create($urlPlan){
        if(!$plan = $this->plan->where('url',$urlPlan)->first()){
            return redirect()->back();
        }

        return view('admin.pages.plans.details.create',['plan' => $plan]);
     }

     public function store(StoreUpdateDetailPlan $request, $urlPlan){
        if(!$plan = $this->plan->where('url',$urlPlan)->first()){
            return redirect()->back();
        }

        $plan->details()->create($request->all());

        return redirect()
            	    ->route('details.plan.index',$urlPlan)
                    ->with('message','Detalhe Craido com sucesso');
     }

     public function edit($urlPlan, $idDetail){
        $plan   = $this->plan->where('url',$urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail ){
            return redirect()->back();
        }


        return view('admin.pages.plans.details.edit',[
            'plan'   => $plan,
            'detail' =>$detail
        ]);
     }

     public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail){
        $plan   = $this->plan->where('url',$urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail ){
            return redirect()->back();
        }
   
        $detail->update($request->all());
        return redirect()
                    ->route('details.plan.index',$urlPlan)
                    ->with('message','Detalhe Actualizado com sucesso');;
     }

     public function show($urlPlan, $idDetail){
        $plan   = $this->plan->where('url',$urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail ){
            return redirect()->back();
        }


        return view('admin.pages.plans.details.show',[
            'plan'   => $plan,
            'detail' =>$detail
        ]);
     }

     public function destroy($urlPlan, $idDetail){
        $plan   = $this->plan->where('url',$urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if(!$plan || !$detail ){
            return redirect()->back();
        }
   
        $detail->delete();
        return redirect()
                    ->route('details.plan.index',$urlPlan)
                    ->with('message','Detalhe deletado com sucesso');
     }
}