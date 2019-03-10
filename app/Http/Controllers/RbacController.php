<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RbacController extends Controller
{
    //
    public function roles()
    {
        $roles = Role::paginate(10);
        return view('rbac.roles',compact('roles'));
    }

    public function rcreate()
    {
        $permissions = Permission::get();
//        return $permissions;
        return view('rbac.rcreate',compact('permissions'));
    }
    //保存添加
    public function sroles(Request $request)
    {

        $this->validate($request,
            ['name'=>'required',],
            ['name.required'=>'权限不能为空']
        );
        $role = Role::create([
            'name' => $request->name
        ]);
            $role->syncPermissions($request->permissions);
        return redirect()->route('roles.index')->with('success','添加成功');
    }
    //修改权限
    public function eroles(Role $role)
    {
        $permissions = Permission::get();
        return view('rbac.eroles',compact('role','permissions'));
    }
    //保存修改
    public function uroles(Request $request,Role $role)
    {
        $this->validate($request,
            ['name'=>'required',],
            ['name.required'=>'权限不能为空',]
        );
        $role->name = $request->name;
        $role->save();
        $role->syncPermissions($request->permissions);
        $request->session()->flash('success','修改成功');
        return redirect()->route('roles.index');
    }
    //删除
    public function droles(Role $role)
    {
        $role->delete();
        session()->flash('success','删除成功');
        return redirect()->route('roles.index');
    }




    //权限表
    public function permission()
    {
        $permissions = Permission::paginate(10);
        return view('rbac.permission',compact('permissions'));
    }
    //添加权限
    public function pcreate()
    {
        return view('rbac.pcreate');
    }
    //保存权限
    public function pstore(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
            ],
            [
                'name.required'=>'权限不能为空',

            ]
        );

        $permission = Permission::create([
            'name' => $request->name,
        ]);
        return redirect()->route('permissions.index')->with('success','添加成功');
    }
    //修改权限
    public function editpermission(Permission $permission)
    {
       return view('rbac.epermission',compact('permission'));
    }
    //保存修改
    public function upermission(Request $request,Permission $permission)
    {
        $this->validate($request,
            [
                'name'=>'required',
            ],
            [
                'name.required'=>'权限不能为空',
            ]
        );
        $permission->name = $request->name;
        $permission->save();
        $request->session()->flash('success','修改成功');
        return redirect()->route('permissions.index');
    }
    //删除
    public function dpermission(Permission $permission)
    {
        $permission->delete();
        session()->flash('success','删除成功');
        return redirect()->route('permissions.index');
    }
}
