<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTable;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    protected $repository;

    public function __construct(Table $table)
    {
        $this->repository = $table;
    }

    public function index()
    {
        $tables = $this->repository->latest()->paginate();
        return view('admin.pages.tables.index',compact('tables'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateTables  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    { 
        $data               = $request->all();

       // $data['tenant_id']  = auth()->user()->tenant_id;

    //dd($data);
        $this->repository->create($data);

        return redirect()
                        ->route('tables.index')                        
                        ->with('message','Mesa Criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$table = $this->repository->where('id',$id)->first())
            return redirect()->back()->with('error','Mesa não encontrado');

        return  view('admin.pages.tables.show',compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$table = $this->repository->where('id',$id)->first())
            return redirect()->back()->with('error','Mesa  não encontrada');

        return  view('admin.pages.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdataTable  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTable $request, $id)
    {
        if(!$category = $this->repository->where('id',$id)->first())
            return redirect()->back()->with('error','Table  não encontrada');
        
        $data = $request->all();

        $category->update($data);

        return redirect()
                    ->route('tables.index')
                    ->with('message','Mesa Editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$category = $this->repository->where('id',$id)->first())
            return redirect()->back()->with('error','Mesa  não encontrada');
        $category->delete();
        return redirect()
                    ->route('tables.index')
                    ->with('message','Mesa Deletada com sucesso');
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

        $tables = $this->repository->where(function($query) use($request){
                                        if($request->filter){
                                            $query->where('identify',$request->filter);
                                            $query->orWhere('desciption','LIKE',"%$request->filter%");
                                        }
                                        })
                                        ->latest()
                                        ->paginate();
        return view('admin.pages.tables.index',compact('tables', 'filters'));
    }
}
