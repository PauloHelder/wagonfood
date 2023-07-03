<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;
    }

    public function index()
    {
        $users = $this->repository->tenantUser()->paginate();
        return view('admin.pages.users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    { 
        $data               = $request->all();
        $data['tenant_id']  = auth()->user()->tenant_id;
        $data['password']   = bcrypt($data['password']);

        $this->repository->create($data);

        return redirect()
                        ->route('users.index')                        
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
        if(!$user = $this->repository->tenantUser()->find($id))
            return redirect()->back()->with('error','Perfil não encontrado');

        return  view('admin.pages.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
            return redirect()->back()->with('error','User não encontrado');

        return  view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        if(!$user = $this->repository->tenantUser()->find($id))
            return redirect()->back()->with('error','user não encontrado');
        
        $data = $request->only('name','email');
        
        if($request->password){
            $data['passowrd'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()
                    ->route('users.index')
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
        if(!$user = $this->repository->tenantUser()->find($id))
            return redirect()->back()->with('error','user não encontrado');
        $user->delete();
        return redirect()
                    ->route('users.index')
                    ->with('message','User Deletado com sucesso');
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

        $users = $this->repository->where(function($query) use($request){
                                        if($request->filter){
                                            $query->where('name','LIKE',"%$request->filter%");
                                            $query->orWhere('email',$request->filter);
                                        }
                                        })
                                        ->latest()
                                        ->tenantUser()
                                        ->paginate();
        return view('admin.pages.users.index',compact('users', 'filters'));
    }
}
