<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index', ['permissions'=>$permissions]);
    }

    public function store(){
        request()->validate([
            'name' => 'required',
        ]);
        Permission::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        return back();
    }

    public function edit(Permission $permission){
        return view('admin.permissions.edit', [
            'permission'=>$permission,
        ]);
    }

    public function update(Permission $permission){
        request()->validate([
            'name' => 'required',
        ]);
        if(Permission::find($permission->id)->slug != Str::of(Str::lower(request('name')))->slug('-')){
            session()->flash('permission-updated', 'Updated Permission ' . request('name'));
        }else{
            session()->flash('permission-updated', 'Nothing to update');
        }
        $permission->update([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        return back();
    }

    public function destroy(Permission $permission){
        $permission->delete();
        session()->flash('permission-deleted', 'Deleted Permission ' . $permission->name);
        return back();
    }
}