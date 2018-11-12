@extends("layouts.default")
@section('title', '登入')
@section('content')
    <div class="card">
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="card-header">
                用户登入
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                           placeholder="请输入名称" value="{{ old('email') }}">
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
                    <label for=""></label>
                    <a href="{{ route('FindPasswordEmail') }}">找回密码</a>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">登入</button>
            </div>
        </form>
    </div>
@endsection