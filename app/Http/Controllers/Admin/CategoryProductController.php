<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    protected $category, $product;

    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product    = $product;
    }
    /**
     * lista  todas as catecorias do produto
     */
    public function categories($idProduct)
    {
        $product = $this->product->find($idProduct);
        if(!$product)
            return redirect()->back()->with('error', 'produto não encontrado');
        $categories = $product->categories()->paginate();
       
        return view('admin.pages.products.categories.categories', compact('categories', 'product'));
    }
    /**
     * lista  todas as catecorias Disponiveis para adicionar aos produtos
     */
    public function categoriesAvailable(Request $request, $idProduct)
    {
        $product = $this->product->find($idProduct);
        if(!$product)
            return redirect()->back()->with('error', 'Perfil não encontrado');
        
        $filters = $request->except('_token');
        $categories = $product->categoriesAvailable($request->filter);

        return view('admin.pages.products.categories.available', compact('categories', 'product', 'filters'));
    }
    /**
     * Adciona categorias aos produtos
     */
    public function attachCategoryProduct(Request $request, $idProduct)
    {   
        $product = $this->product->find($idProduct);
        if(!$product)
            return redirect()->back()->with('error', 'Produto não encontrado');
        
        if(!$request->categories || count($request->categories) == 0)
            return redirect()->back()->with('alert', 'Selecione ao menos uma permissão');
            
        $product->categories()->attach($request->categories);
        return redirect()
                    ->route('products.categories',$idProduct)
                    ->with('message','Permissões adicionadas com sucesso');


    }
    /**
     * Remove categorias dos produtos
     */
    public function dettachCategoryProduct($idProduct, $idCategory)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idCategory);

        if(!$product || !$category)
            return redirect()->back()->with('alert', 'Selecione ao menos uma Categoria');

         $product->categories()->detach($category);   
         return redirect()
                    ->route('products.categories',$idProduct)
                    ->with('info','Categoria Removida com sucesso');


    }
    
    /**
     * Produtos da Categoria
     */
    public function products($idCategory)
    {
        $category= $this->category->find($idCategory);
        if(!$category)
            return redirect()->back()->with('error', 'Categoria não encontrado');
        
        $products = $category->products()->paginate();
        
        return view('admin.pages.products.products', compact('category', 'products'));
    }
    /**
     * lista dos produtos disponiveis para adicionar a categoria
     */
    public function productsAvailable(Request $request, $idPermission)
    {
        $category= $this->category->find($idPermission);
        if(!$category)
            return redirect()->back()->with('error', 'Permissão não encontrado');
        
        $filters = $request->except('_token');
        $products = $category->productsAvailable($request->filter);

        return view('admin.pages.categories.products.available', compact('category', 'products', 'filters'));
    }
    /**
     * Adciona produto a categoria 
     */
    public function attachProductCategory(Request $request, $idCategory)
    {   
        $category = $this->category->find($idPermission);
        if(!$category)
            return redirect()->back()->with('error', 'Permissão não encontrado');
        
        if(!$request->products || count($request->products) == 0)
            return redirect()->back()->with('alert', 'Selecione ao menos um perfil');
            
        $category->products()->attach($request->products);
        return redirect()
                    ->route('categories.products',$idPermission)
                    ->with('message','Perfil adicionado com sucesso');


    }
    /**
     * Remove Produtos das Categorias
     */
    public function detachProfilePermission($idPermission,$idProduct)
    {
        $product = $this->product->find($idProduct);
        $category = $this->category->find($idPermission);

        if(!$product || !$category)
            return redirect()->back()->with('alert', 'Selecione ao menos uma permissão');

         $category->products()->detach($product);   
         return redirect()
                    ->route('categories.products',$idPermission)
                    ->with('info','Perfil Removido com sucesso');


    }
}
