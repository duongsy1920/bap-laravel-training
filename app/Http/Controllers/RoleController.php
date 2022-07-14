<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Role;
use App\Permission;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', ['roles'=>$roles]);
    }

    public function store(){
        request()->validate([
            'name' => 'required',
        ]);
        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        return back();
        
    }

    public function destroy(Role $role){
        $role->delete();
        session()->flash('role-deleted', 'Deleted Role ' . $role->name);
        return back();
    }

    public function edit(Role $role){
        return view('admin.roles.edit', [
            'role'=>$role,
            'permissions'=>Permission::all(),
        ]);
    }

    public function update(Role $role){
        request()->validate([
            'name' => 'required',
        ]);
        if(Role::find($role->id)->slug != Str::of(Str::lower(request('name')))->slug('-')){
            session()->flash('role-updated', 'Role Updated ' . request('name'));
        }else{
            session()->flash('role-updated', 'Nothing to update');
        }
        $role->update([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        return back();
    }

    public function attach_Permission(Role $role){

        $role->permissions()->attach(request('permissions'));

        return back();

    }

    public function detach_Permission(Role $role){

        $role->permissions()->detach(request('permissions'));

        return back();

    }

}