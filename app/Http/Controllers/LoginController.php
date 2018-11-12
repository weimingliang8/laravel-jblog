<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //自定义错误信息
        $messages = [
            'email.required' => '输入邮箱~~~'
        ];
        //过虑
        $data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ], $messages);
//        dd($request->all());
        if (\Auth::attempt($data)) {
            session()->flash('success', '登入成功');
            return redirect('/');
        }
        session()->flash('danger', '账号或密码错误');
        return back();
    }

    public function loginout()
    {
        \Auth::logout();
        session()->flash('success', '退出成功');
        return redirect('/');
    }
}
