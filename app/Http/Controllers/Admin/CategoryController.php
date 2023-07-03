<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $repository;

    public function __construct(Category $category)
    {
        $this->repository = $category;
    }

    public function index()
    {
        $categories = $this->repository->latest()->paginate();
        return view('admin.pages.categories.index',compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateCategory  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateCategory $request)
    { 
        $data               = $request->all();

       // $data['tenant_id']  = auth()->user()->tenant_id;

    //dd($data);
        $this->repository->create($data);

        return redirect()
                        ->route('categories.index')                        
                        ->with('message','Categoria Criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        if(!$category = $this->repository->where('url',$url)->first())
            return redirect()->back()->with('error','Categoria não encontrado');

        return  view('admin.pages.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($url)
    {
        if(!$category = $this->repository->where('url',$url)->first())
            return redirect()->back()->with('error','Categoria  não encontrada');

        return  view('admin.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCategory $request, $url)
    {
        if(!$category = $this->repository->where('url',$url)->first())
            return redirect()->back()->with('error','Categoria  não encontrada');
        
        $data = $request->all();

        $category->update($data);

        return redirect()
                    ->route('categories.index')
                    ->with('message','Categoria Editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        if(!$category = $this->repository->where('url',$url)->first())
            return redirect()->back()->with('error','Categoria  não encontrada');
        $category->delete();
        return redirect()
                    ->route('categories.index')
                    ->with('message','Categoria Deletada com sucesso');
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

        $categories = $this->repository->where(function($query) use($request){
                                        if($request->filter){
                                            $query->where('name',$request->filter);
                                            $query->orWhere('description','LIKE',"%$request->filter%");
                                        }
                                        })
                                        ->latest()
                                        ->paginate();
        return view('admin.pages.categories.index',compact('categories', 'filters'));
    }
}
