@extends('adminlte::page')

@section('title', '書籍詳細')


<!-- 商品一覧画面に戻る -->
@section('content_header')
<form action="/items">
    <div class="text-left">
        <button type="submit">戻る</button>
    </div>
</form>

<!-- 商品詳細 -->
<div class="mt-5">
    <h1>書籍詳細</h1>
</div>
@stop

@section('content')

<div class="container my-5">
    <div class="panel-body"> 
        <table class=table style="font-size: 120%">
            <tbody>
                <tr>
                    <th scope="col">ID</th>
                    <td>
                        <div>{{$item->id}}</div>
                    </td>
                </tr>

                <tr>
                    <th>タイトル</th>
                    <td>
                        <div>{{$item->name}}</div>
                    </td>
                </tr>

                <tr>
                    <th>ジャンル</th>
                    <td>
                        <div>
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
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <th>著者</th>
                    <td>
                        <div>{{$item->author}}</div>
                    </td>
                </tr>

                <tr>
                    <th>価格</th>
                    <td>
                        <div>{{$item->price}}</div>
                    </td>
                </tr>

                <tr>
                    <th>詳細</th>
                    <td>
                        <div>{{$item->detail}}</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@stop