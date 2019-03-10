<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    //
    public function index()
    {
        $navs = Nav::paginate(10);
        return view('navs.index',compact('navs'));
    }

    public function create()
    {
        $navs = Nav::all();
        $permissions = Permission::all();
        return view('navs.create',compact('navs','permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'url'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'url.required'=>'路由不能为空',
            ]
        );
        $nav = new Nav();
        $nav->name = $request->name;
        $nav->url = $request->url;
        $nav->permission_id = $request->permission_id;
        $nav->pid = $request->pid;
        $nav->save();
//        $nav -> can('');
        return redirect()->route('navs.index')->with('success','添加成功');
    }

    public function edit(Nav $nav)
    {
        $navs = Nav::all();
        $permissions = Permission::all();
        return view('navs.edit',compact('nav','navs','permissions'));
    }

    public function update(Request $request,Nav $nav)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'url'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'url.required'=>'路由不能为空',
            ]
        );

        $nav->name = $request->name;
        $nav->url = $request->url;
        $nav->permission_id = $request->permission_id;
        $nav->pid = $request->pid;
        $nav->save();
//        $nav -> can('');
        return redirect()->route('navs.index')->with('success','修改成功');
    }


    public function destroy(Nav $nav)
    {
        $nav->delete();
        session()->flash('success','删除成功');
        return redirect()->route('navs.index');
    }


    public function aaaa()
    {
        $navs = [];
       $ns =  Nav::where('pid',1)->get();
       foreach ($ns as $n){
           $nav = Nav::where('pid',$n->id)->get();
           $navs[$n->name] = $nav;
       }
       return view('test.test',compact('navs'));
    }
}
