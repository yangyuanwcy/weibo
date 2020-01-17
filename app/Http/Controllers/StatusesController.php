<?php

namespace App\Http\Controllers;

use Auth;
use HttpException;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|max:140'
        ]);
        $user=Auth::user();
        $status=$user->statuses()->create([
            'content'=>$request['content']
        ]);
        if(isset($status)){
            session()->flash('success','发布成功！');
        }else{
            session()->flash('failed','噢，NO,您发布的状态迷路了！');
        }
        return redirect()->back();
    }
}
