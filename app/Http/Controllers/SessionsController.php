<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;

class SessionsController extends Controller
{
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
        /*if(Hash::check($request->password ,auth()->user($request->email)->getAuthPassword())){
        //if(password_verify($request->password,auth()->user($request->email)->getAuthPassword())){
            echo "yes";
        }
        return;*/
        if(Auth::attempt($credentials,$request->has('remember'))){
            session()->flash('success','欢迎回来！');
            return redirect()->route('users.show',[Auth::user()]);
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
