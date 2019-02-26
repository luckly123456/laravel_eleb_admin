<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Shopcategorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        //dd($keyword);
        if ($keyword) {
            $shops = Shop::where('title', 'like', "%$keyword%")->paginate(10);
        } else {
            $shops = Shop::paginate(10);
        }
        return view('shops.index', compact('shops', 'keyword'));
    }

    public function create()
    {
        $shopcategories = Shopcategorie::all();
        return view('shops.create',compact('shopcategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'shop_name'=>'required',
                'shop_category_id'=>'required',
                'shop_rating'=>'required',
                'brand'=>'required',
                'on_time'=>'required',
                'fengniao'=>'required',
                'bao'=>'required',
                'piao'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'discount'=>'required',
                'status'=>'required',

            ],
            [//错误提示信息
                'shop_name.required'=>'店铺名称不能为空',
                'shop_category_id.required'=>'所属分类不能为空',
                'shop_rating.required'=>'评分不能为空',
                'brand.required'=>'品牌不能为空',
                'on_time.required'=>'准时送达不能为空',
                'fengniao.required'=>'蜂鸟配送不能为空',
                'bao.required'=>'保标记不能为空',
                'piao.required'=>'保标记不能为空',
                'zhun.required'=>'准标记不能为空',
                'start_send.required'=>'起送金额不能为空',
                'send_cost.required'=>'配送费不能为空',
                'notice.required'=>'店公告不能为空',
                'discount.required'=>'优惠信息不能为空',
                'status.required'=>'状态不能为空',

            ]
        );
        Shop::create([

            'shop_name'=>$request->shop_name,
            'shop_category_id'=>$request->shop_category_id,
            'shop_img'=>$request->img,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status,
        ]);
        return redirect()->route('shops.index')->with('success','添加成功');
    }

    //修改
    public function edit(Shop $shop)
    {
        $shopcategories = Shopcategorie::all();
        return view('shops.edit',compact('shop','shopcategories'));
    }


    public function update(Shop $shop,Request $request)
    {
        $this->validate($request,
            [
                'shop_name'=>'required',
                'shop_category_id'=>'required',
                'shop_rating'=>'required',
                'brand'=>'required',
                'on_time'=>'required',
                'fengniao'=>'required',
                'bao'=>'required',
                'piao'=>'required',
                'start_send'=>'required',
                'send_cost'=>'required',
                'discount'=>'required',
                'status'=>'required',

            ],
            [//错误提示信息
                'shop_name.required'=>'店铺名称不能为空',
                'shop_category_id.required'=>'所属分类不能为空',
                'shop_rating.required'=>'评分不能为空',
                'brand.required'=>'品牌不能为空',
                'on_time.required'=>'准时送达不能为空',
                'fengniao.required'=>'蜂鸟配送不能为空',
                'bao.required'=>'保标记不能为空',
                'piao.required'=>'保标记不能为空',
                'zhun.required'=>'准标记不能为空',
                'start_send.required'=>'起送金额不能为空',
                'send_cost.required'=>'配送费不能为空',
                'notice.required'=>'店公告不能为空',
                'discount.required'=>'优惠信息不能为空',
                'status.required'=>'状态不能为空',

            ]
        );
        $shop->shop_name = $request->shop_name;
        $shop->shop_category_id = $request->shop_category_id;
        $shop->shop_img = $request->img;
        $shop->shop_rating = $request->shop_rating;
        $shop->brand = $request->brand;
        $shop->on_time = $request->on_time;
        $shop->fengniao = $request->fengniao;
        $shop->bao = $request->bao;
        $shop->piao = $request->piao;
        $shop->zhun = $request->zhun;
        $shop->start_send = $request->start_send;
        $shop->send_cost = $request->send_cost;
        $shop->notice = $request->notice;
        $shop->discount = $request->discount;
        $shop->status = $request->status;
        $shop->save();

        //设置操作提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('shops.index');
    }

    //删除
    public function destroy(Shop $shop)
    {
        $shop->delete();
        session()->flash('success','删除成功');
        return redirect()->route('shops.index');
    }

    public function upload(Request $request)
    {
        $img = $request->file('file');
//        $path = Storage::url($img->store('public/menus'));
        $path = Storage::url($img->store('public/menus'));
        return ['path'=>$path];
    }

}
