<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    //登陆
    public function login()
    {
        if (Auth::check()){
            return redirect()->route('sign.index');
        }
        return view('login/login');
    }

    //登陆提交
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'captcha'=>'required|captcha',
            ],
            [
                'name.required'=>'名称不能为空',
                'password.required'=>'密码不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'验证码不正确',
            ]
        );
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required'
        ]);

        if(Auth::attempt([
            'name'=>$request->name,
            'password'=>$request->password
        ],$request->has('rememberMe'))){
            return redirect()->intended(route('admins.index'))->with('success','登录成功');
        }else{
            return back()->with('danger','账号密码不正确');
        }
    }

    public function sign()
    {
        return view('login/sign');
    }

    public function signin(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required',
                'password2'=>'required',
                'email'=>'required',
                'captcha'=>'required|captcha',
            ],
            [//错误提示信息
                'name.required'=>'名称不能为空',
                'password.required'=>'密码不能为空',
                'password2.required'=>'确认密码不能为空',
                'email.required'=>'邮箱不能为空',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'验证码不正确',
            ]
        );

        Admin::create([

            'name'=>$request->name,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'status'=>1,
            'shop_id'=>$request->shop_id,
        ]);
        return redirect()->route('login')->with('success','注册成功');
    }

    //用户注销
    public function destroy()
    {
        Auth::logout();//注销登录
        return redirect()->route('login')->with('success','您已安全退出');
    }
}
