@extends("layouts.default")
@section('title', '首页')
@section('content')
    @auth
        <form method="post" action="{{ route('blog.store') }}">
            @csrf
            <div class="card">
                <div class="card-header">
                    发布博客
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">内容</label>
                        <textarea class="form-control" name="content" id="" rows="3">{{ old('content') }}</textarea>
                    </div>
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" class="btn btn-success">发表</button>
                </div>
            </div>
        </form>
    @endauth
    <div class="card">
        <div class="card-header">
            博客列表
        </div>
        <div class="card-body">
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
                            @can('delete', $blog)
                                <form action="{{ route('blog.destroy', $blog) }}" method="post">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger">删除</button>
                                </form>
                            @endcan
                        </td>
                        <td>
                            <a href="{{ route('user.show', $blog->user) }}"> {{ $blog->user->name }} </a>
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
