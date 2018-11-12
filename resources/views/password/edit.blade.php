@extends('layouts.default')
@section('content')
    <form action="{{ route('FindPasswordUpdate') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $user['email_token'] }}">
        <div class="card">
            <div class="card-header">
                重置密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="text" disabled class="form-control" name="email" id="email" value="{{ $user['email'] }}">
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
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">重置</button>
            </div>
        </div>
    </form>
@endsection