@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<!-- ユーザー一覧画面に戻る -->
<form action="/user">
    <div class="text-left">
        <button type="submit">戻る</button>
    </div>
</form>

<!-- ユーザー情報編集画面 -->
<div class="mt-5">
    <h1>ユーザー情報編集画面</h1>
</div>
@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card card-primary">
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
                    <label for="password1">現在のパスワード:</label>
                    <input type="password" name="currentPassword" value="" class="mb-3">
                </div>
                <div>
                    <label for="password2">新しいパスワード:</label>
                    <input type="password" name="newPassword" value="" class="mb-3">
                </div>
                <div>
                    <label for="password3">パスワード（確認用）:</label>
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
            <form action="{{ url('user/delete') }}" method="GET">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">削除</button>
                    <input type="hidden" name="id" value="{{$user->id}}">
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop