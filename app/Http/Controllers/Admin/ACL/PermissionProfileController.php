<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $permission, $profile;

    public function __construct(Permission $permission, Profile $profile)
    {
        $this->permission = $permission;
        $this->profile    = $profile;
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile)
            return redirect()->back()->with('error', 'Perfil não encontrado');
        $permissions = $profile->permissions()->paginate();
        
        return view('admin.pages.profiles.permissions.permissions', compact('permissions', 'profile'));
    }

    public function permissionsAvailable(Request $request, $idProfile)
    {
        $profile = $this->profile->find($idProfile);
        if(!$profile)
            return redirect()->back()->with('error', 'Perfil não encontrado');
        
        $filters = $request->except('_token');
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('permissions', 'profile', 'filters'));
    }

    public function attachPermissionsProfile(Request $request, $idProfile)
    {   
        $profile = $this->profile->find($idProfile);
        if(!$profile)
            return redirect()->back()->with('error', 'Perfil não encontrado');
        
        if(!$request->permissions || count($request->permissions) == 0)
            return redirect()->back()->with('alert', 'Selecione ao menos uma permissão');
            
        $profile->permissions()->attach($request->permissions);
        return redirect()
                    ->route('profiles.permissions',$idProfile)
                    ->with('message','Permissões adicionadas com sucesso');


    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission)
            return redirect()->back()->with('alert', 'Selecione ao menos uma permissão');

         $profile->permissions()->detach($permission);   
         return redirect()
                    ->route('profiles.permissions',$idProfile)
                    ->with('info','Permissões Removida com sucesso');


    }
    /**
     * Permissions dos Profiles
     */
    public function profiles($idPermission)
    {
        $permission= $this->permission->find($idPermission);
        if(!$permission)
            return redirect()->back()->with('error', 'Permissão não encontrado');
        
        $profiles = $permission->profiles()->paginate();
        
        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles'));
    }

    public function profilesAvailable(Request $request, $idPermission)
    {
        $permission= $this->permission->find($idPermission);
        if(!$permission)
            return redirect()->back()->with('error', 'Permissão não encontrado');
        
        $filters = $request->except('_token');
        $profiles = $permission->profilesAvailable($request->filter);

        return view('admin.pages.permissions.profiles.available', compact('permission', 'profiles', 'filters'));
    }

    public function attachProfilesPermission(Request $request, $idPermission)
    {   
        $permission = $this->permission->find($idPermission);
        if(!$permission)
            return redirect()->back()->with('error', 'Permissão não encontrado');
        
        if(!$request->profiles || count($request->profiles) == 0)
            return redirect()->back()->with('alert', 'Selecione ao menos um perfil');
            
        $permission->profiles()->attach($request->profiles);
        return redirect()
                    ->route('permissions.profiles',$idPermission)
                    ->with('message','Perfil adicionado com sucesso');


    }

    public function detachProfilePermission($idPermission,$idProfile)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if(!$profile || !$permission)
            return redirect()->back()->with('alert', 'Selecione ao menos uma permissão');

         $permission->profiles()->detach($profile);   
         return redirect()
                    ->route('permissions.profiles',$idPermission)
                    ->with('info','Perfil Removido com sucesso');


    }

}
