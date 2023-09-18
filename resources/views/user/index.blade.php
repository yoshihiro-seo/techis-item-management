@extends('adminlte::page')

@section('title', 'ユーザー一覧')

<!-- ユーザー一覧画面 -->
@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
<div class="m-5">
    <table class="table table-bordered table-hover table-sm">
        <thead>
            <tr>
                <th>ユーザーID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>権限</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <!-- ユーザーID -->
                <td class="table-text">
                    <div>{{$user->id}}</div>
                </td>
                <!-- 名前 -->
                <td class="table-text">
                    <div>{{$user->name}}</div>
                </td>
                <!-- メールアドレス -->
                <td class="table-text">
                    <div>{{$user->email}}</div>
                </td>
                <!-- 権限 -->
                <td class="table-text">

                    @if($user->role === 0)
                        <div>一般ユーザー</div>
                    @else
                        <div>管理者</div>
                    @endif
                </td>

                <!-- 編集ボタン -->
                <td>
                    <form action="/user/edit/{{$user->id}}" method="GET">
                        <button class="btn btn-primary">編集</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- ページネーション -->
    <div class="d-flex justify-content-center">
        {{$users->links('pagination::bootstrap-4')}}
    </div>

</div>
@stop