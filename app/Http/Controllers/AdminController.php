<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $admins = Admin::where('title', 'like', "%$keyword%")->paginate(10);
        } else {
            $admins = Admin::paginate(10);
        }
        return view('admins.index', compact('admins', 'keyword'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'email'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'password.required'=>'密码不能为空',
                'email.required'=>'邮箱不能为空',
            ]
        );
        Admin::create([

            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
        ]);
        return redirect()->route('admins.index')->with('success','添加成功');
    }



    public function edit(Admin $admin)
    {

        return view('admins.edit',compact('admin'));
    }

    public function update(Admin $admin,Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'email.required'=>'邮箱不能为空',
            ]
        );
        $admin->name = $request->name;
        $admin->email = $request->email;
        return redirect()->route('admins.index')->with('success','添加成功');
    }

    //删除
    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('success','删除成功');
        return redirect()->route('admins.index');
    }

    public function reset(Admin $admin)
    {
        return view('admins.reset',compact('admin'));
    }

    public function resetped(Admin $admin,Request $request){
        $admin->password = Hash::make($request->password);
        return redirect()->route('admins.index');
    }

}
