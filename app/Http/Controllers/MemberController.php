<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    //
    public function index()
    {
        $members = Member::paginate(10);
        return view('member.index',compact('members'));
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'username'=>'required',
                'password'=>'required',
                'password2'=>'required',
            ],
            [
                'username.required'=>'用户名不能为空',
                'password.required'=>'密码不能为空',
                'password2.required'=>'确认密码不能为空',
            ]);
        Member::create([

            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'tel'=>$request->tel,
        ]);
        return redirect()->route('members.index')->with('success','添加成功');
    }

    public function status(Member $member)
    {
        if ($member->status == 0){
        Member::where('id','=',$member->id)->update([
            'status'=>1,
        ]);}else{
            Member::where('id','=',$member->id)->update([
                'status'=>0,
            ]);
        }
        return redirect()->route('members.index')->with('success','修改成功');
    }
}
