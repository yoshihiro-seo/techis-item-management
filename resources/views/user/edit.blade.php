@extends('adminlte::page')

@section('title', 'Dashboard')

<!-- ユーザー情報編集画面 -->
@section('content_header')
    <h1>ユーザー情報編集画面</h1>
@stop

@section('content')
<div class="m-5">
    <form action="/user/userUpdate" method="POST" id="userUpdate">
        {{csrf_field()}}
        <div>
            <label for="id">ユーザーID:</label>
            <input type="text" name="id" value="{{old('id', $user->id)}}" class="mb-3" readonly>
        </div>
        <div>
            <label for="name">名前:</label>
            <input type="text" name="name" value="{{old('name', $user->name)}}" class="mb-3">
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="text" name="email" value="{{old('email', $user->email)}}" class="mb-3">
        </div>
        <div>
            <label for="password">現在のパスワード:</label>
            <input type="password" name="password" value="" class="mb-3">
        </div>
        <div>
            <label for="password">新しいパスワード:</label>
            <input type="password" name="newPassword" value="" class="mb-3">
        </div>
        <div>
            <label for="password">パスワード（確認用）:</label>
            <input type="password" name="newPassword2" value="" class="mb-3">
        </div>
        <div>
            <label for="role">権限:</label>
                <div>
                    <label for="role0">一般ユーザー</label>
                    <input type="radio" name="role" value="0" class="" @if(old('role', $user->role)== 0) checked @endif>
                </div>
                <div>
                    <label for="role1">管理者</label>
                    <input type="radio" name="role" value="1" class="" @if(old('role', $user->role)== 1) checked @endif>
                </div>
        </div>
        <!-- 更新ボタン -->
        <div class="card-footer">
            <button type="submit" class="btn btn-primary" form="userUpdate">更新</button>
        </div>
    </form>
    
    <!-- 削除ボタン -->
    <form action="/user/delete" method="GET">
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">削除</button>
            <input type="hidden" name="id" value="{{$user->id}}">
        </div>
    </form>
</div>
@stop