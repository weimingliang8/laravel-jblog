@extends('layouts.default')
@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="text-center">{{ $user->name }}</h1>
            <div class="text-center">
                <a href="{{ route('follower', $user) }}" class="btn btn-info mr-2">粉丝（{{ $user->follower()->count() }}）</a>
                <a href="{{ route('following', $user) }}" class="btn btn-info mr-2">关注（{{ $user->following()->count() }}）</a>
                @auth
                    <a href="{{ route('user.follow', $user) }}" class="btn btn-success">
                        {{ $followTitle }}
                    </a>
                @endauth
            </div>
        </div>
        <div class="card-block">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($blogs AS $blog)
                    <tr>
                        <td>
                            {{ $blog['content'] }}
                        </td>
                        <td>
                            @can('delete', $blog)
                                <form action="{{ route('blog.destroy', $blog) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">删除</button>
                                </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            {{ $blogs->links() }}
        </div>
    </div>
@endsection