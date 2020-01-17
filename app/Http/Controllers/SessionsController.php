<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',[
            'only'=>['create']
        ]);
    }

    //
    public function create()
    {
        return view('sessions.create');
    }
    public function store(Request $request)
    {
        $credentials=$this->validate($request,[
           'email'=>'required|email|max:255',
           'password'=>'required'
        ]);
        /*var_dump(auth()->user());
        if(Hash::check($request->password ,auth()->user($request->email)->getAuthPassword())){
        //if(password_verify($request->password,auth()->user($request->email)->getAuthPassword())){
            echo "yes";
        }
        return;*/
        if(Auth::attempt($credentials,$request->has('remember'))){
            if(Auth::user()->activated){
                session()->flash('success','欢迎回来！');
                $fallback=route('users.show',Auth::user());
                //重定向到之前访问到页面，附带一个默认地址，若历史访问链接为空，则跳转到默认页面$fallback
                //return redirect()->intended($fallback);
                return redirect()->route('users.show',[Auth::user()]);
            }else{
                Auth::logout();
                session()->flash('warning','你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }

        }else{
            session()->flash('danger','很抱歉，您的邮箱和密码不匹配');
            //return redirect()->back()->withInput();
            return redirect()->back()->exceptInput('password');
        }
    }
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','欢迎下次再来');
        return redirect('login');
        return redirect()->route('login');
    }
}
