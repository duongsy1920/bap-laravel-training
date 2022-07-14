<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $users = User::all();

        return view('admin.users.index', ['users'=>$users]);

    }

    public function show(User $user){
        return view('admin.users.profile', [
            'user'=>$user,
            'roles' => Role::all()
        ]);
    }

    public function update(User $user, UserRequest $request){
        $dataUpdate = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password != null) {
            $dataUpdate['password'] = $request->password;
        }

        if(request('avatar')){
            $dataUpdate['avatar'] = request('avatar')->store('images');
        }

        $user->update($dataUpdate);
        session()->flash('user-updated-messages', 'User was updated successfully');

        return back();
    }

    public function attach(User $user){
            
        $user->roles()->attach(request('role'));

        return back();
    }

    public function detach(User $user){

        $user->roles()->detach(request('role'));

        return back();
    }

    public function destroy(User $user){

        $user->delete();

        session()->flash('user-deleted', 'User has been deleted');

        return back();

    }

    public function create() {
        return view('admin.users.create');
    }

    public function store(UserRequest $request){
        $dataUpdate = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(request('avatar')){
            $dataUpdate['avatar'] = request('avatar')->store('images');
        }
        User::create($dataUpdate);
        session()->flash('user-created-messages', 'User was created successfully');
        return redirect()->route('users.index');
    }
}
