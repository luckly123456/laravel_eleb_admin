<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Menucategorie;
use Illuminate\Http\Request;

class MenuController extends Controller
{
//    //
//    public function __construct()
//    {
//        $this->middleware('auth',[
//            'except'=>['index']
//        ]);
//    }

    public function index(Request $request)
    {
        $wheres = [];
        $keyword = $request->keyword;
        $goods_price1 = $request->goods_price1;
        $goods_price2 = $request->goods_price2;
        if($keyword) $wheres[]=['goods_name','like',"%$keyword%"];
        if($goods_price1) $wheres[]=['goods_price1','>=',$goods_price1];
        if($goods_price2) $wheres[]=['goods_price2','<=',$goods_price2];
        $menus = Menu::where($wheres)->paginate(10);
        return view('menus.index',compact('menus'));
    }

    //添加商品
    public function create()
    {
        $menucategories = Menucategorie::where('shop_id',Auth()->user()->id)->paginate(10);
        return view('menus.create',compact('menucategories'));
    }

    //保存添加商品
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'goods_name'=>'required',
                'goods_price'=>'required',
                'description'=>'required',
                'tips'=>'required',
                'category_id'=>'required',
                'status'=>'required',

            ],
            [//错误提示信息
                'goods_name.required'=>'名称不能为空',
                'goods_price.required'=>'价格不能为空',
                'description.required'=>'描述不能为空',
                'tips.required'=>'提示信息不能为空',
                'category_id.required'=>'所属分类不能为空',
                'status.required'=>'状态不能为空',
            ]
        );
        Menu::create([
            'goods_name'=>$request->goods_name,
            'rating'=>0,
            'shop_id'=>Auth()->user()->id,
            'category_id'=>$request->category_id,
            'goods_price'=>$request->goods_price,
            'description'=>$request->description,
            'month_sales'=>0,
            'rating_count'=>0,
            'tips'=>$request->tips,
            'satisfy_count'=>0,
            'satisfy_rate'=>0,
            'goods_img'=>$request->img,
            'status'=>$request->status,
        ]);
        return redirect()->route('menus.index')->with('success','添加成功');
    }

    public function edit(Menu $menu)
    {
        $menucategories = Menucategorie::where('shop_id',Auth()->user()->id)->paginate(10);
        return view('menus.edit',compact('menu','menucategories'));
    }

    public function update(Menu $menu,Request $request)
    {
        $this->validate($request,
            [
                'goods_name'=>'required',
                'goods_price'=>'required',
                'description'=>'required',
                'tips'=>'required',
                'category_id'=>'required',
                'status'=>'required',
                'rating'=>'required',
                'month_sales'=>'required',
                'img'=>'required|max:2048'

            ],
            [//错误提示信息
                'goods_name.required'=>'名称不能为空',
                'goods_price.required'=>'价格不能为空',
                'description.required'=>'描述不能为空',
                'tips.required'=>'提示信息不能为空',
                'category_id.required'=>'所属分类不能为空',
                'status.required'=>'状态不能为空',
                'rating.required'=>'评分不能为空',
                'month_sales.required'=>'	月销量不能为空',
                'rating_count.required'=>'评分数量不能为空',
                'satisfy_count.required'=>'满意度数量不能为空',
                'satisfy_rate.required'=>'满意度评分不能为空',
                'img.required'=>'请上传图片',
                'img.max'=>'图片大小不能超过2m',
            ]
        );
        $img = $request->file('img');
        $path = $img->store('public/menus');

        $menu->goods_name = $request->goods_name;
        $menu->rating = $request->rating;
        $menu->category_id = $request->category_id;
        $menu->goods_price = $request->goods_price;
        $menu->description = $request->description;
        $menu->month_sales = $request->month_sales;
        $menu->rating_count = $request->rating_count;
        $menu->tips = $request->tips;
        $menu->satisfy_count = $request->satisfy_count;
        $menu->satisfy_rate = $request->satisfy_rate;
        $menu->goods_img = url(Storage::url($path));
        $menu->save();

        //设置操作提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('menus.index');
    }
    public function destroy(Menu $menu)
    {
        $menu->delete();
        session()->flash('success','删除成功');
        return redirect()->route('menus.index');
    }


    //保存图片
    public function upload(Request $request)
    {
        $img = $request->file('file');
//        $path = Storage::url($img->store('public/menus'));
        $path = Storage::url($img->store('public/menus'));
        return ['path'=>$path];
    }
}
