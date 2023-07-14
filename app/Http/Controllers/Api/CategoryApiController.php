<?php

namespace App\Http\Controllers\Api;

use App\Services\CategoryService;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesByTenant(TenantFormRequest $request){
        return CategoryResource::collection($this->categoryService->getCategoryByUuid($request->company));
    }


}
