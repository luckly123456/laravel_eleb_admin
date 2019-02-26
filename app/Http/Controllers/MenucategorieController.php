<?php

namespace App\Http\Controllers;

use App\Models\Menucategorie;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenucategorieController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword){
            $menucategories = Menucategorie::where('title','like',"%$keyword%")->paginate(10);
        }else{
            $menucategories = Menucategorie::paginate(10);
        }
        return view('menucategories.index',compact('menucategories','keyword'));
    }

    //添加商品分类
    public function create()
    {
        $shops = Shop::all();
        return view('menucategories.create',compact('shops'));
    }

    //保存添加商品
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'shop_id'=>'required',
                'description'=>'required',
                'is_selected'=>'required',

            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'shop_id.required'=>'所属商家不能为空',
                'description.required'=>'描述不能为空',
                'is_selected.required'=>'所属商家不能为空',
            ]
        );

        if ($request->is_selected == 1){
            DB::table('menucategories')->where([['is_selected',1],['shop_id',$request->shop_id]])->update(['is_selected'=>0]);
        }

        Menucategorie::create([
            'name'=>$request->name,
            'shop_id'=>$request->shop_id,
            'type_accumulation'=>'abc',
            'description'=>$request->description,
            'is_selected'=>$request->is_selected,
        ]);





        return redirect()->route('menucategories.index')->with('success','添加成功');
    }



    //修改商品分类
    public function edit(Menucategorie $menucategorie)
    {
        $shops = Shop::all();
        return view('menucategories.edit',compact('menucategorie','shops'));
    }

    //修改保存
    public function update(Menucategorie $menucategorie,Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'shop_id'=>'required',
                'description'=>'required',
                'is_selected'=>'required',

            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'status.required'=>'所属商家不能为空',
                'description.required'=>'描述不能为空',
                'is_selected.required'=>'所属商家不能为空',
            ]
        );

        if ($request->is_selected == 1){
            DB::table('menucategories')->where([['is_selected',1],['shop_id',$request->shop_id]])->update(['is_selected'=>0]);
        }
        $menucategorie->name = $request->name;
        $menucategorie->shop_id = $request->shop_id;
        $menucategorie->description = $request->description;
        $menucategorie->is_selected = $request->is_selected;
        $menucategorie->save();

        //设置操作提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('menucategories.index');
    }

    //删除
    public function destroy(Menucategorie $menucategorie)
    {
        $menucategorie->delete();
        session()->flash('success','删除成功');
        return redirect()->route('menucategories.index');
    }


}
