@extends('adminlte::page')

@section('title', 'Dashboard')

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
                <th>ステータス</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($user as $user)
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
                    <form action="/user/{{$user->id}}" method="GET">
                        <button class="btn-default">編集</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop