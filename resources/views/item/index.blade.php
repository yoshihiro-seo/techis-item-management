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

                                <input type="text" name="keyword" value="{{ $keyword }}">
                                <input type="submit" value="検索">
                            </form>
                        </div>

                        <!-- 検索機能 (ジャンル) -->
                        <div>
                            <form action="/items/search/type" method="GET" class="form-controll ml-3" style="display:inline-flex">
                            @csrf
                                <select name="keyword2" id="keyword2" class="form-control" style="width: 100%">
                                    <option value="" selected hidden>ジャンルを選択</option>
                                    <option value="1" {{ $keyword2 == 1 ? "selected" : ""}}>文学・文芸（小説など）</option>
                                    <option value="2" {{ $keyword2 == 2 ? "selected" : ""}}>ビジネス</option>
                                    <option value="3" {{ $keyword2 == 3 ? "selected" : ""}}>趣味・実用</option>
                                    <option value="4" {{ $keyword2 == 4 ? "selected" : ""}}>専門書</option>
                                    <option value="5" {{ $keyword2 == 5 ? "selected" : ""}}>学習参考書</option>
                                    <option value="6" {{ $keyword2 == 6 ? "selected" : ""}}>絵本・児童書</option>
                                    <option value="7" {{ $keyword2 == 7 ? "selected" : ""}}>コミックス</option>
                                    <option value="8" {{ $keyword2 == 8 ? "selected" : ""}}>雑誌</option>
                                    <option value="9" {{ $keyword2 == 9 ? "selected" : ""}}>その他</option>
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
                                <th>価格(円)</th>
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
