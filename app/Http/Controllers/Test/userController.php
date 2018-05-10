<?php

namespace App\Http\Controllers\Test;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public function __construct()
    {
        //除了 except 数组中指定的动作，其他的动作都必须登录以后才能操作
        $this->middleware('auth',[
            'except' =>['show','create','store','index']
        ]);

       //使用 Auth 中间件提供的 guest 选项，用于指定一些只允许未登录用户访问的动作
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index(){
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    //处理注册表单数据
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:50',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|confirmed|min:6'
        ]);
        $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
        ]);
        Auth::login($user);
        session()->flash('success','欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show',[$user]);
    }

    //用户编辑
    public function edit(User $user){

        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }

    //处理用户编辑数据
    public function update(User $user,Request $request){
//          dd($request);
        $this->validate($request,[
            'name' =>'required|max:50',
//            'password'=>'required|confirmed|min:6'
            'password'=>'nullable|confirmed|min:6'
        ]);
        /**
         * 这里 update 是指授权类里的 update 授权方法，
         * $user 对应传参 update 授权方法的第二个参数
         */
        $this->authorize('update', $user);

        $data['name'] = $request->name;
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show',$user->id);
    }

    //删除用户
    public function destroy(User $user){
        //删除动作的授权中，我们规定只有当前用户为管理员，且被删除用户不是自己时，授权才能通过
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success','成功删除用户！');
        return back();
    }
}
