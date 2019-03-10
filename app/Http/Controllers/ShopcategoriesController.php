<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shopcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopcategoriesController extends Controller
{
    //
    public function index()

    {
        $shopcategories = Shopcategorie::paginate(10);
        return view('shopcategories.index',compact('shopcategories'));
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
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'status.required'=>'状态不能为空',
            ]
        );

        Shopcategorie::create([
            'name'=>$request->name,
            'status'=>$request->status,
            'img'=>$request->img,
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
            ],
            [
                'name.required'=>'名称不能为空',
                'status.required'=>'状态不能为空',
            ]
        );
        $shopcategorie->name = $request->name;
        $shopcategorie->status = $request->status;
        $shopcategorie->img = $request->img;
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

    public function upload(Request $request)
    {
        $img = $request->file('file');
        $path = Storage::url($img->store('public/shopcategories'));
        return ['path'=>$path];
    }

    public function show(Shopcategorie $shopcategorie,Request $request){
//        $shops = Shop::where('shop_category_id','=',"$shopcategorie")->paginate(10);

        $shops = Shop::where('shop_category_id','=',"$shopcategorie->id")->paginate(10);
        return $shopcategorie;
    }
}
