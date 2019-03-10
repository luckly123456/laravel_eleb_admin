<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $users = User::where('title', 'like', "%$keyword%")->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        return view('users.index', compact('users', 'keyword'));
    }

    public function create()
    {
        $shops = Shop::all();
        return view('users.create',compact('shops'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'password2'=>'required',
                'email'=>'required',
                'shop_id'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'password.required'=>'密码不能为空',
                'password2.required'=>'确认密码不能为空',
                'email.required'=>'邮箱不能为空',
                'shop_id.required'=>'所属商家不能为空',
            ]
        );
        User::create([

            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'status'=>1,
            'shop_id'=>$request->shop_id,
        ]);
        return redirect()->route('users.index')->with('success','添加成功');
    }

    //修改
    public function edit(User $user)
    {
        $shops = Shop::all();
        return view('users.edit',compact('user','shops'));
    }

    public function update(User $user,Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required',
                'shop_id'=>'required',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'email.required'=>'邮箱不能为空',
                'shop_id.required'=>'所属商家不能为空',
            ]
        );


        $user->name = $request->name;
        $user->email = $request->email;
        $user->shop_id = $request->shop_id;

        $user->save();

        //设置操作提示信息
        $request->session()->flash('success','修改成功');
        return redirect()->route('users.index');
    }

    //删除
    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success','删除成功');
        return redirect()->route('users.index');
    }
    
    //审核
    public function audit()
    {
            $users = User::where('status', '=', "0")->paginate(10);
        return view('users.audit', compact('users'));
    }

    //审核
    public function check(User $user)
    {
        $user->status =1;
        $user->save();


        $title = '全新体验，手机也能玩转网易邮箱2.0';
        $content = '<p>	重要的邮件如何才能让对方立刻查看随身邮，可以让您享受随时短信提醒和发送邮件可以短信通知收件人的服务，重要的邮件一个都不能少！</p>';
        try{
            \Illuminate\Support\Facades\Mail::send('email.default',compact('title','content'),
                function($message){
                    $to = '1607384710@qq.com';
                    $message->from(env('MAIL_USERNAME'))->to($to)->subject('饿了吧商家审核啦');
                });
        }catch (Exception $e){
            return '邮件发送失败';
        }



        $users = User::where('status', '=', "0")->paginate(10);
        return view('users.audit', compact('users'));
    }

    public function reset(User $user)
    {
        return view('users.reset',compact('user'));
    }

    public function resetped(User $user,Request $request){
        $user->password = Hash::make($request->password);
        return redirect()->route('users.index');
    }


    public function upload(Request $request)
    {
        $img = $request->file('file');
//        $path = Storage::url($img->store('public/menus'));
        $path = Storage::url($img->store('public/menus'));
        return ['path'=>$path];
    }
}
