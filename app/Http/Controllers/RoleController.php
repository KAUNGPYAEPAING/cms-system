<?php

namespace App\Http\Controllers;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Permission;

class RoleController extends Controller
{
    //
    public function index(){
        $roles = Role::all();
        return view('admin.roles.index', ['roles'=>$roles]);
    }

    public function store(){

        request()->validate([
            'name'=>['required']
        ]);



        Role::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('_')
        ]);



        return back();
    }

    public function destroy(Role $role){
        $role->delete();

        return back();
    }

    public function edit(Role $role){
        return view('admin.roles.edit', ['role'=>$role, 'permissions'=>Permission::all()]);
    }

    public function update(Role $role){
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('_');

        $role->save();

        session()->flash('role-updated', 'Role updated ' . $role->name);

        return back();
    }

    
    public function attach(Role $role){
        $role->permissions()->attach(request('permission'));

        return back();
    }

    public function detach(Role $role){
        $role->permission()->detach(request('permission'));

        return back();
    }
}

