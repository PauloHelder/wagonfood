<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $repository;

    public function __construct(Product $product)
    {
        $this->repository = $product;
    }

    public function index()
    {
        $products = $this->repository->latest()->paginate();
        return view('admin.pages.products.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateProduct  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    { 
        $data               = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            $data['image']=$request->image->store("tenants/{$tenant->uuid}/products");

        }

       // $data['tenant_id']  = auth()->user()->tenant_id;

    //dd($data);
        $this->repository->create($data);

        return redirect()
                        ->route('products.index')                        
                        ->with('message','Produto Criada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        if(!$product = $this->repository->where('url',$uuid)->first())
            return redirect()->back()->with('error','Produto não encontrado');

        return  view('admin.pages.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        if(!$product = $this->repository->where('uuid',$uuid)->first())
            return redirect()->back()->with('error','Produto  não encontrada');

        return  view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $uuid)
    {
        if(!$product = $this->repository->where('uuid',$uuid)->first())
            return redirect()->back()->with('error','Produto  não encontrado');
        
        $data = $request->all();
        $tenant = auth()->user()->tenant;
        if($request->hasFile('image') && $request->image->isValid()){
            $data['image']=$request->image->store("tenants/{$tenant->uuid}/products");

        }
        $product->update($data);

        return redirect()
                    ->route('products.index')
                    ->with('message','Produto Editada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        if(!$product = $this->repository->where('uuid',$uuid)->first())
            return redirect()->back()->with('error','Produto  não encontrada');
        $product->delete();
        return redirect()
                    ->route('products.index')
                    ->with('message','Produto Deletada com sucesso');
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

        $products = $this->repository->where(function($query) use($request){
                                        if($request->filter){
                                            $query->where('name',$request->filter);
                                            $query->orWhere('description','LIKE',"%$request->filter%");
                                        }
                                        })
                                        ->latest()
                                        ->paginate();
        return view('admin.pages.products.index',compact('products', 'filters'));
    }
}
