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
            <label for="id">ユーザーID</label>
            <input type="text" name="id" value="{{old('id', $user->id)}}" class="mb-3" readonly>
        </div>
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" value="{{old('name', $user->name)}}" class="mb-3">
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input type="text" name="email" value="{{old('email', $user->email)}}" class="mb-3">
        </div>
        <div>
            <label for="pass">現在のパスワード</label>
            <input type="text" name="password" value="" class="mb-3">
        </div>
        <div>
            <label for="pass">新しいパスワード</label>
            <input type="text" name="newPassword" value="" class="mb-3">
        </div>
        <div>
            <label for="password">パスワード（確認用）</label>
            <input type="text" name="newPassword2" value="" class="mb-3">
        </div>
        <div>
            <label for="role">権限</label>
                <div>
                    <label for="role0">一般ユーザー</label>
                    <input type="radio" name="role" value="0" class="" @if(old('role', $user->role)== 0) checked @endif>
                </div>
                <div>
                    <label for="role1">管理者</label>
                    <input type="radio" name="role" value="1" class="" @if(old('role', $user->role)== 1) checked @endif>
                </div>
        </div>
    </form>

    <!-- 更新ボタン -->
    <div>
        <button type="submit" class="btn btn-secondary" form="userUpdate">更新</button>
    </div>

    <!-- 削除ボタン -->
    <div>
    </div>
</div>
@stop