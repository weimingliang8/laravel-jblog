<?php

namespace App\Http\Controllers;

use App\Mail\RegMail;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'show', 'create', 'store', 'confirmEmailToken']
        ]);

        $this->middleware('guest', [
            'only' => ['create', 'store']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
//        dd($users);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        dd(33);
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request)
    public function store(UserRequest $request)
    {
        //自定义错误信息
        $messages = [
            'name.required' => '名称不能为空~~~',
            'email.required' => '输入邮箱~~~'
        ];
        //过虑
        $data = $this->validate($request, [
            'name' => 'bail|required|min:3|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ], $messages);

        //加密
        $data['password'] = bcrypt($data['password']);
        //保存记录到数据库
        $user = User::create($data);
        //发送邮件验证
        \Mail::to($user)->send(new RegMail($user));
        session()->flash('success', '请查看邮箱完成验证');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $blogs = $user->blog()->paginate(10);
        if (\Auth::check()) {
            $followTitle = $user->isFollow(\Auth::user()->id) ? '取消关注' : '关注';
        }
        return view('user.show', compact('user', 'blogs', 'followTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//        dd($request->toArray(), $user->toArray());
        //过虑
        $this->validate($request, [
            'name' => 'required|min:3',
            'password' => 'nullable|min:5|confirmed'
        ]);
        $user->name = $request->name;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        session()->flash('success', '修改成功');
        return redirect()->route('user.show', $user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
//        dd($user);
        $this->authorize('delete', $user);
        $user->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('user.index');
    }

    /**
     * 注册邮箱验证
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmEmailToken($token)
    {
        $user = User::where('email_token', $token)->first();
        if ($user) {
            $user->email_active = true;
            $user->save();
            session()->flash('验证成功');
            \Auth::login($user);
            return redirect('/');
        }
        session()->flash('邮箱验证失败');
        return redirect('/');
    }

    public function follow(User $user)
    {
        $user->followToggle(\Auth::user()->id);
        return back();
    }
}
