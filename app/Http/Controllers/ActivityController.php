<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $wheres = [];
        if ($keyword == 1){
            $wheres[]=['start_time','>',date('Y-m-d h:m:s')];
        }elseif ($keyword == 2){
            $wheres[]=['end_time','>',date('Y-m-d h:m:s')];
            $wheres[]=['start_time','<',date('Y-m-d h:m:s')];
        }elseif ($keyword == 3){
            $wheres[]=['end_time','<',date('Y-m-d h:m:s')];
        }else{
            $wheres = [];
        }
//        $activitys = Activity::paginate(10);
        $activitys = Activity::where($wheres)->paginate(10);
        return view('activitys.index',compact('activitys'));
    }

    public function create()
    {
        return view('activitys.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',

            ],
            [//错误提示信息
                'title.required'=>'标题不能为空',
                'content.required'=>'内容不能为空',
                'start_time.required'=>'开始时间不能为空',
                'end_time.required'=>'结束时间不能为空',

            ]
        );

        Activity::create([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        return redirect()->route('activitys.index')->with('success','添加成功');
    }

    public function edit(Activity $activity)
    {
        return view('activitys.edit',compact('activity'));
    }

    public function update(Activity $activity,Request $request)
    {

        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',

            ],
            [//错误提示信息
                'title.required'=>'标题不能为空',
                'content.required'=>'内容不能为空',
                'start_time.required'=>'开始时间不能为空',
                'end_time.required'=>'结束时间不能为空',

            ]
        );

        $activity->title = $request->title;
        $activity->content = $request->input('content');
        $activity->start_time = $request->start_time;
        $activity->end_time = $request->end_time;
        $activity->save();

        //设置操作提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('activitys.index');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        session()->flash('success','删除成功');
        return redirect()->route('activitys.index');
    }
}
