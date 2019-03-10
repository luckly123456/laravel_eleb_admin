<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Eventmember;
use App\Models\Eventprize;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    //列表
    public function index()
    {
        $events = Event::paginate(10);
        return view('events.index',compact('events'));
    }

    //活动详情
    public function show(Event $event)
    {
        $eventprizes = Eventprize::where('events_id',$event->id)->get();
        return view('events.show',compact('eventprizes','event'));
    }

    //添加商品
    public function eventpc(Event $event)
    {
        return view('events.createprize',compact('event'));
    }
    //保存添加商品
    public function createprize(Request $request,Event $event)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'奖品名不能为空',
                'description.required'=>'详情不能为空',
            ]);

//        $eventprize = new Eventprize();
//        $eventprize->name=$request
        Eventprize::create([
            'events_id'=>$event->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'member_id'=>0,
        ]);
        return redirect()->route('events.index')->with('success','添加成功');
    }
    //开奖
    public function kprize(Event $event)
    {
        $event->is_prize = 1;
        $event->save();

        $eventpries = Eventprize::where('events_id',$event->id)->get();
        $users = Eventmember::where('events_id',$event->id)->get()->toArray();

//        return $users;
//        $num = count(json_decode($users));
//        $users[rand(0,$num-1)];
//
//        return array_pop($users)['id'];

        foreach ($eventpries as $eventprie){
            Eventprize::where('id',$eventprie->id)->update([
                'member_id'=>array_pop($users)['id'],
            ]);

//            $title = '中奖啦';
//            $content = '<p>	恭喜您,抽中了'.$eventprie->title.'</p>';
//            try{
//                \Illuminate\Support\Facades\Mail::send('email.default',compact('title','content'),
//                    function($message){
//                        $to = '1607384710@qq.com';
//                        $message->from(env('MAIL_USERNAME'))->to($to)->subject('恭喜你中奖啦');
//                    });
//            }catch (Exception $e){
//                return '邮件发送失败';
//            }
        }

        return redirect()->route('events.index')->with('success','开奖成功');
    }

    public function mans(Event $event)
    {
        $users =[];
        $mans = Eventmember::where('events_id',$event->id)->get();
        foreach ($mans as $man){
            $users = User::where('id',$man->member_id)->get();
            return view('events.mans',compact('users','event'));
        }
    }

    //添加活动
    public function create()
    {
        return view('events.create');
    }
    //保存活动
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
            ],
            [
                'title.required'=>'活动名不能为空',
                'content.required'=>'详情不能为空',
                'signup_start.required'=>'开始时间不能为空',
                'signup_end.required'=>'结束时间不能为空',
                'prize_date.required'=>'开奖时间不能为空',
                'signup_num.required'=>'人数限制不能为空',
            ]);
        Event::create([

            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0,
        ]);
        return redirect()->route('events.index')->with('success','添加成功');
    }
    //修改活动
    public function edit(Event $event)
    {
        return view('events.edit',compact('event'));
    }
    //保存修改活动
    public function update(Request $request,Event $event)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
            ],
            [
                'title.required'=>'活动名不能为空',
                'content.required'=>'详情不能为空',
                'signup_start.required'=>'开始时间不能为空',
                'signup_end.required'=>'结束时间不能为空',
                'prize_date.required'=>'开奖时间不能为空',
                'signup_num.required'=>'人数限制不能为空',
            ]);
        $event->title = $request->title;
        $event->content = $request->input('content');
        $event->signup_start = strtotime($request->signup_start);
        $event->signup_end = strtotime($request->signup_end);
        $event->prize_date = $request->prize_date;
        $event->signup_num = $request->signup_num;
        $event->save();
        return redirect()->route('events.index')->with('success','修改成功');
    }
    //删除活动
    public function destroy(Event $event)
    {
        $event->delete();
        session()->flash('success','删除成功');
        return redirect()->route('events.index');
    }
}
