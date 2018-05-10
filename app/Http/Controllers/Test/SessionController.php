<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    public function __construct(){
        //使用 Auth 中间件提供的 guest 选项，用于指定一些只允许未登录用户访问的动作
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

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
            if(Auth::user()->activated){
                //登录成功
                session()->flash('success','欢迎回来！');

                //intended 方法，该方法可将页面重定向到上一次请求尝试访问的页面上，并接收一个默认跳转地址参数，当上一次请求记录为空时，跳转到默认地址上
                return redirect()->intended(route('users.show',[Auth::user()]));
            }else{
                Auth::logout();
                session()->flash('warning','你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }


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
