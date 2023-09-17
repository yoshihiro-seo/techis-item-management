@extends('adminlte::page')

@section('title', '書籍一覧')

@section('content_header')
    <h1>書籍一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <!-- <h3 class="card-title">書籍一覧</h3> -->

                    
                    <div style="display:inline-flex">
                        <!-- 検索機能 (タイトル・作者・価格)-->
                        <div>
                            <form action="/items/search" method="GET">
                            @csrf

                                <input type="text" name="keyword" value="">
                                <input type="submit" value="検索">
                            </form>
                        </div>

                        <!-- 検索機能 (ジャンル) -->
                        <div>
                            <form action="/items/search/type" method="GET" class="form-controll ml-3" style="display:inline-flex">
                            @csrf
                                <select name="keyword2" id="keyword2" class="form-control" style="width: 100%">
                                    <option value="" selected hidden>ジャンルを選択</option>
                                    <option value="1" @if(1 === (int)request('keyword2')) selected @endif>文学・文芸（小説など）</option>
                                    <option value="2" @if(2 === (int)request('keyword2')) selected @endif>ビジネス</option>
                                    <option value="3" @if(3 === (int)request('keyword2'))selected @endif>趣味・実用</option>
                                    <option value="4" @if(4 === (int)request('keyword2')) selected @endif>専門書</option>
                                    <option value="5" @if(5 === (int)request('keyword2')) selected @endif>学習参考書</option>
                                    <option value="6" @if(6 === (int)request('keyword2')) selected @endif>絵本・児童書</option>
                                    <option value="7" @if(7 === (int)request('keyword2'))selected @endif>コミックス</option>
                                    <option value="8" @if(8 === (int)request('keyword2')) selected @endif>雑誌</option>
                                    <option value="9" @if(9 === (int)request('keyword2')) selected @endif>その他</option>
                                </select>
                                <div class="">
                                    <button type="submit" class="btn btn-secondary ml-3 text-nowrap">ジャンル検索</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-primary">書籍登録</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- テーブル -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>タイトル</th>
                                <th>ジャンル</th>
                                <th>作者</th>
                                <th>価格</th>
                                <th>更新日時</th>
                                <!-- <th>お気に入り</th> -->
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <!-- ID -->
                                    <td>{{ $item->id }}</td>
                                    <!-- タイトル -->
                                    <td>{{ $item->name }}</td>
                                    <!-- ジャンル -->
                                    <td>
                                        @if($item->type === 1)
                                                文学・文芸(小説など)
                                            @elseif ($item->type === 2)
                                                ビジネス
                                            @elseif ($item->type === 3)
                                                趣味・実用
                                            @elseif ($item->type === 4)
                                                専門書
                                            @elseif ($item->type === 5)
                                                学習参考書
                                            @elseif ($item->type === 6)
                                                絵本・児童書
                                            @elseif ($item->type === 7)
                                                コミックス
                                            @elseif ($item->type === 8)
                                                雑誌
                                            @elseif ($item->type === 9)
                                                その他
                                            @endif
                                    </td>
                                    <!-- 著者 -->
                                    <td>{{ $item->author }}</td>
                                    <!-- 価格 -->
                                    <td>{{ number_format($item->price)}}</td>
                                    <!-- 更新日時 -->
                                    <td>{{ $item->updated_at }}</td>
                                    <!-- お気に入り -->
                                    <!-- <td>★</td> -->
                                    <td>
                                        <form action="/items/detail/{{$item->id}}" method="GET">
                                            <button type="submit" class="btn btn-primary">詳細</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/items/edit/{{$item->id}}" method="GET">
                                            <button type="submit" class="btn btn-primary">編集</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- ページネーション -->
                    <div class="d-flex justify-content-center">
                        {{$items->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
