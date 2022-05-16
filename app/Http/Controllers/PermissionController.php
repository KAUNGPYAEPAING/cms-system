<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //
    public function index(){
        $permissions = Permission::all();

        return view('admin.permissions.index', ['permissions'=>$permissions]);
    }

    public function store(){
        request()->validate([
            'name'=>['required']
        ]);



        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('_')
        ]);



        return back();
    }

    public function destroy(Permission $permission){
        $permission->delete();

        return back();
    }
}
