<?php

namespace App\Http\Controllers;

use App\Models\Shopcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopcategoriesController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        //dd($keyword);
        if($keyword){
            $shopcategories = Shopcategorie::where('title','like',"%$keyword%")->paginate(10);
        }else{
            $shopcategories = Shopcategorie::paginate(10);
        }
        return view('shopcategories.index',compact('shopcategories','keyword'));
    }

    //添加商品分类
    public function create()
    {
        return view('shopcategories.create');
    }

    //保存添加商品
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'status'=>'required',
                'img'=>'required|image|max:2048'
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'status.required'=>'状态不能为空',
                'img.required'=>'请上传图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过2k',
            ]
        );
        //获取上传的文件，并保存到服务器
        $img = $request->file('img');
        //保存文件
        $path = $img->store('public/shopcategories');
        Shopcategorie::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>url(Storage::url($path))
        ]);
        return redirect()->route('shopcategories.index')->with('success','添加成功');
    }

    //修改商品分类
    public function edit(Shopcategorie $shopcategorie)
    {
        return view('shopcategories.edit',compact('shopcategorie'));
    }
    //修改保存
    public function update(Shopcategorie $shopcategorie,Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'status'=>'required',
                'img'=>'required|image|max:2048'
            ],
            [
                'name.required'=>'名称不能为空',
                'status.required'=>'状态不能为空',
                'img.required'=>'请上传图片',
                'img.image'=>'图片格式不正确',
                'img.max'=>'图片大小不能超过2k',
            ]
        );
        $img = $request->file('img');
        //保存文件
        $path = $img->store('public/shopcategories');

        $shopcategorie->name = $request->name;
        $shopcategorie->status = $request->status;
        $shopcategorie->img = url(Storage::url($path));
        $shopcategorie->save();

        //设置操作提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('shopcategories.index');
    }

    //删除
    public function destroy(Shopcategorie $shopcategorie)
    {
        $shopcategorie->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shopcategories.index');
    }
}
