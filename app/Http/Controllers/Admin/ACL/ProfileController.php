<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfile;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $repository;

    public function __construct(Profile $profile)
    {
        $this->repository = $profile;
    }

    public function index()
    {
        $profiles = $this->repository->paginate();
        return view('admin.pages.profiles.index',compact('profiles'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateProfile  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfile $request)
    {
        $this->repository->create($request->all());

        return redirect()
                        ->route('profiles.index')
                        ->with('message','Perfil Criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$profile = $this->repository->find($id))
            return redirect()->back()->with('error','Perfil não encontrado');

        return  view('admin.pages.profiles.show',compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$profile = $this->repository->find($id))
            return redirect()->back()->with('error','Perfil não encontrado');

        return  view('admin.pages.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateProfile  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProfile $request, $id)
    {
        if(!$profile = $this->repository->find($id))
            return redirect()->back()->with('error','Perfil não encontrado');
        $profile->update($request->all());
        return redirect()
                    ->route('profiles.index')
                    ->with('message','Perfil Editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$profile = $this->repository->find($id))
            return redirect()->back()->with('error','Perfil não encontrado');
        $profile->delete();
        return redirect()
                    ->route('profiles.index')
                    ->with('message','Perfil Deletado com sucesso');
    }

    /**
     * search Result.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request){
        $filters = $request->only('filter');

        $profiles = $this->repository->where(function($query) use($request){
                                        if($request->filter){
                                            $query->where('name',$request->filter);
                                            $query->orWhere('description','LIKE',"%$request->filter%");
                                        }
                                        })
                                        ->paginate();
        return view('admin.pages.profiles.index',compact('profiles', 'filters'));
    }
}
