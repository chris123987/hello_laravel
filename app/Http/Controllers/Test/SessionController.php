<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //登录页面
    public function create(){
        return view('session.create');
    }

    //处理登录数据
    public function store(Request $re){

        $credentials = $this->validate($re,[
            'email' =>'required|email|max:255',
            'password' =>'required'
        ]);
        if(Auth::attempt($credentials,$re->has('remember'))){
            //登录成功
            session()->flash('success','欢迎回来！');
            return redirect()->route('users.show',[Auth::user()]);

        }else{
            //登录失败
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            return redirect()->back();
        }

    }

    //退出
    public function destroy(){
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
