<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Str;

class CategoryObserver
{
    /**
     * Handle the category "created" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function creating(Category $category)
    {
        $countUrl = Category::where('name',$category->name)->count();
        if($countUrl >= 1){
            $url = Str::slug($category->name);
            $category->url = $url."-".$countUrl ;
        }else{
            $category->url = Str::slug($category->name);
        }
        
    }

    /**
     * Handle the category "updated" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function updating(Category $category)
    {
        $countUrl = Category::where('name',$category->name)->count();
        if($countUrl >= 1){
            $url = Str::slug($category->name);
            $category->url = $url."-".$countUrl ;
        }else{
            $category->url = Str::slug($category->name);
        }
    }

    /**
     * Handle the category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        //
    }

    /**
     * Handle the category "restored" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function restored(Category $category)
    {
        //
    }

    /**
     * Handle the category "force deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function forceDeleted(Category $category)
    {
        //
    }
}
