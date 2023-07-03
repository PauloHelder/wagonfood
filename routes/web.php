<?php
Route::prefix('admin')
        ->middleware('auth')
        ->namespace('Admin')
        ->group(function(){

             /**
             * Rotas Produtsc
             */
            Route::any('products/search', 'ProductController@search')->name('products.search');
            Route::resource('products', 'ProductController');


              /**
             * Rotas Categories
             */
            Route::any('categories/search', 'CategoryController@search')->name('categories.search');
            Route::resource('categories', 'CategoryController');

            /**
             * Rotas User
             */
            Route::any('user/search', 'UserController@search')->name('users.search');
            Route::resource('users', 'UserController');


            /**
             * Rotas profile Profile
             */
            Route::get('profile/{id}/plans/{idPlan}/detach', 'ACL\PlanProfileController@detachPlansProfile')->name('profiles.plans.detach');
            Route::post('profile/{id}/plans/store', 'ACL\PlanProfileController@attachPlansProfile')->name('profiles.plans.attach');
            Route::any('profile/{id}/plans/create', 'ACL\PlanProfileController@plansAvailable')->name('profiles.plans.available');
            Route::get('profile/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');

            /**
             * Rotas Plan Profile
             */
            Route::get('plan/{id}/profiles/{idProfile}/detach', 'ACL\PlanProfileController@detachProfilesPlan')->name('plans.profile.detach');
            Route::post('plan/{id}/profiles/store', 'ACL\PlanProfileController@attachProfilesPlan')->name('plans.profiles.attach');
            Route::any('plan/{id}/profile/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
            Route::get('plan/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');

            /**
             * Rotas permissions Profile
             */
            Route::get('permissions/{id}/profiles/{idProfile}/detach', 'ACL\PermissionProfileController@detachProfilePermission')->name('permission.profile.detach');
            Route::post('permissions/{id}/profiles/store', 'ACL\PermissionProfileController@attachProfilesPermission')->name('permissions.profiles.attach');
            Route::any('permissions/{id}/profile/create', 'ACL\PermissionProfileController@profilesAvailable')->name('permissions.profiles.available');
            Route::get('permissions/{id}/profiles', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

            /**
             * Rotas Profile permissions
             */
            Route::get('profiles/{id}/permissions/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profile.permission.detach');
            Route::post('profiles/{id}/permissions/store', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
            Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
            Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
            
            /**
             * Rotas permissions
             */
            Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
            Route::resource('permissions', 'ACL\PermissionController');

            /**
             * Rotas Profile
             */
            Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
            Route::resource('profiles', 'ACL\ProfileController');


            /**
             * Routas Details Plan
             */
            Route::delete('plans/{url}/details/{idDetail}','DetailPlanController@destroy')->name('details.plan.destroy');
            Route::get('plans/{url}/details/{idDetail}','DetailPlanController@show')->name('details.plan.show');
            Route::put('plans/{url}/details/{idDetail}','DetailPlanController@update')->name('details.plan.update');
            Route::get('plans/{url}/details/{idDetail}/edit','DetailPlanController@edit')->name('details.plan.edit');
            Route::post('plans/{url}/details','DetailPlanController@store')->name('details.plan.store');
            Route::get('plan/{url}/details/create','DetailPlanController@create')->name('details.plan.create');
            Route::get('plans/{url}/details','DetailPlanController@index')->name('details.plan.index');


            /**
             * Routas Plan
             */
            Route::put('plan/{url}','PlanController@update')->name('plans.update');
            Route::get('plan/{url}/edit','PlanController@edit')->name('plans.edit');
            Route::any('search','PlanController@search')->name('plans.search');
            Route::delete('plan/{url}','PlanController@destroy')->name('plans.delete');
            Route::get('plan/{url}','PlanController@show')->name('plans.show');
            Route::post('plans','PlanController@store')->name('plans.store');
            Route::get('plans','PlanController@index')->name('plans.index');
            
            Route::get('plans/create','PlanController@create')->name('plans.create');
            
            Route::get('/','PlanController@index')->name('admin.index');

        });

Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/** Rotas de Autehticação */
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
