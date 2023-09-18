@extends('adminlte::page')

@section('title', 'ユーザー情報編集')

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

        <div class="card card-body">
            <form action="/user/userUpdate" method="POST" id="userUpdate">
                {{csrf_field()}}
                <div class="row mb-3">
                    <label for="id" class="col-sm-3 col-form-label">ユーザーID:</label>
                    <div class="col-sm-8">
                        <input type="text" name="id" value="{{old('id', $user->id)}}" class="mb-3 form-control-plaintext"" readonly>
                    </div>
                    
                </div>

                <div class="row mb-3">
                    <label for="name" class="col-sm-3 col-form-label">名前:</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" value="{{old('name', $user->name)}}" class="mb-3">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-sm-3 col-form-label">メールアドレス:</label>
                    <div class="col-sm-8">
                        <input type="text" name="email" value="{{old('email', $user->email)}}" class="mb-3">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password1" class="col-sm-3 col-form-label">現在のパスワード:</label>
                    <div class="col-sm-8">
                        <input type="password" name="currentPassword" value="" class="mb-3">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label for="password2" class="col-sm-3 col-form-label">新しいパスワード:</label>
                    <div class="col-sm-8">
                        <input type="password" name="newPassword" value="" class="mb-3">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password3" class="col-sm-3 col-form-label">パスワード（確認用）:</label>
                    <div class="col-sm-8">
                        <input type="password" name="newPassword2" value="" class="mb-3">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="role" class="col-sm-3 col-form-label">権限:</label>
                    <div class="mt-2">
                        <div class="">
                            <label for="role0">一般ユーザー</label>
                            <input type="radio" name="role" value="0" class="" 
                                @if(old('role', $user->role)== 0) checked @endif
                                {{ $loginuser->role == 0 ? "disabled" : ""}}>
                        </div>
                        <div class="">
                            <label for="role1">管理者</label>
                            <input type="radio" name="role" value="1" class="" 
                                @if(old('role', $user->role)== 1) checked @endif
                                {{ $loginuser->role == 0 ? "disabled" : ""}}>
                        </div>
                    </div>
                </div>

                <!-- 更新ボタン -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-5" form="userUpdate">更新</button>
                    <button type="button" class="btn btn-primary" onclick="deleteForm()" form="userUpdate" {{ $loginuser->role == 0 ? "disabled" : ""}}>削除</button>
                </div>
            </form>

            <!-- 削除ボタン -->
            <form action="{{ url('user/delete') }}" method="GET" name="deleteform">
                <div class="card-footer">
                    <input type="hidden" name="id" value="{{$user->id}}">
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
<script>
    function deleteForm() {
        //alert("test");
        document.deleteform.submit();
    }
</script>
@stop