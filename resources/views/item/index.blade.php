@extends('adminlte::page')

@section('title', '書籍一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">書籍一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">書籍登録</a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <th>お気に入り</th>
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
                                    <td>{{ $item->price }}</td>
                                    <!-- 更新日時 -->
                                    <td>{{ $item->updated_at }}</td>
                                    <!-- お気に入り -->
                                    <td>★</td>
                                    <td>
                                        <form action="/items/detail/{{$item->id}}" method="GET">
                                            <button type="submit">詳細</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/items/edit/{{$item->id}}" method="GET">
                                            <button type="submit">編集</button>
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
