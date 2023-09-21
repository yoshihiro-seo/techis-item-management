@extends('adminlte::page')

@section('title', '書籍登録')

@section('content_header')
<!-- 商品一覧画面に戻る -->
<form action="/items">
    <div class="text-left">
        <button type="submit">戻る</button>
    </div>
</form>
<div class="mt-5">
    <h1>書籍登録</h1>
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
                <form method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">タイトル</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="タイトル" value="{{old('name')}}">
                        </div>

                        <div class="form-group">
                            <label for="type">ジャンル</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="" selected hidden>選択してください</option>
                                    <option value="1" @if(1 === (int)old('type')) selected @endif>文学・文芸（小説など）</option>
                                    <option value="2" @if(2 === (int)old('type')) selected @endif>ビジネス</option>
                                    <option value="3" @if(3 === (int)old('type')) selected @endif>趣味・実用</option>
                                    <option value="4" @if(4 === (int)old('type')) selected @endif>専門書</option>
                                    <option value="5" @if(5 === (int)old('type')) selected @endif>学習参考書</option>
                                    <option value="6" @if(6 === (int)old('type')) selected @endif>絵本・児童書</option>
                                    <option value="7" @if(7 === (int)old('type')) selected @endif>コミックス</option>
                                    <option value="8" @if(8 === (int)old('type')) selected @endif>雑誌</option>
                                    <option value="9" @if(9 === (int)old('type')) selected @endif>その他</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="author">著者</label>
                            <input type="text" class="form-control" id="author" name="author" placeholder="著者" value="{{old('author')}}">
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <!-- <input type="text" class="form-control" id="price" name="price" placeholder="価格" value="{{number_format(old('price'))}}"> -->
                            <input type="text" class="form-control" id="price" name="price" placeholder="価格" value="{{old('price')}}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="詳細説明">{{old('detail')}}</textarea>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
