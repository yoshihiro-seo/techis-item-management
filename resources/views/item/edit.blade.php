@extends('adminlte::page')

@section('title', '商品情報編集')


@section('content_header')
<!-- 商品一覧画面に戻る -->
<form action="/items">
    <div class="text-left">
        <button type="submit">戻る</button>
    </div>
</form>

<!-- 商品情報編集 -->
<div class="mt-5">
    <h1>商品情報編集</h1>
        <h2>ID:{{$item->id}}</h2>
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
                <form action="/items/update" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">タイトル</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name', $item->name)}}">
                        </div>

                        <div class="form-group">
                            <!-- プルダウン -->
                            <label for="type">ジャンル</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="1" {{old('type', $item->type) == 1 ? 'selected' : '' }}>文学・文芸（小説など）</option>
                                    <option value="2" {{old('type', $item->type) == 2 ? 'selected' : '' }}>ビジネス</option>
                                    <option value="3" {{old('type', $item->type) == 3 ? 'selected' : '' }}>趣味・実用</option>
                                    <option value="4" {{old('type', $item->type) == 4 ? 'selected' : '' }}>専門書</option>
                                    <option value="5" {{old('type', $item->type) == 5 ? 'selected' : '' }}>学習参考書</option>
                                    <option value="6" {{old('type', $item->type) == 6 ? 'selected' : '' }}>絵本・児童書</option>
                                    <option value="7" {{old('type', $item->type) == 7 ? 'selected' : '' }}>コミックス</option>
                                    <option value="8" {{old('type', $item->type) == 8 ? 'selected' : '' }}>雑誌</option>
                                    <option value="9" {{old('type', $item->type) == 9 ? 'selected' : '' }}>その他</option>
                                </select>
                        </div>

                        <div class="form-group">
                            <label for="author">著者</label>
                            <input type="text" class="form-control" id="author" name="author" value="{{old('author', $item->author)}}">
                        </div>

                        <div class="form-group">
                            <label for="price">価格</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{old('price', $item->price)}}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea class="form-control" id="detail" name="detail" rows="3">{{old('detail', $item->detail)}}</textarea>
                        </div>
                    </div>

                    <!-- 更新ボタン -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                    </div>
                </form>

                <!-- 削除ボタン -->
                <form action="/items/delete" method="GET">
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">削除</button>
                        <input type="hidden" name="id" value="{{$item->id}}">
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