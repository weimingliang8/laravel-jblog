@extends('layouts.default')
@section('content')
    <div class="card">
        <form method="post" action="{{ route('user.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="card-header">
                修改资料
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="name">账号</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp"
                           placeholder="请输入名称" value="{{ $user['name'] }}">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" name="password" class="form-control" id="password"
                           placeholder="请输入密码">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">确认密码</label>
                    <input type="password" name="password_confirmation" class="form-control"
                           id="password_confirmation" placeholder="请再次输入密码">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">确认修改</button>
            </div>
        </form>
    </div>
@endsection