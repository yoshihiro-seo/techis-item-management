<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧画面
     */
    // public function index()
    // {
    //     // 商品一覧取得
    //     $items = Item::orderBy('id', 'asc')->paginate(10);
    //     return view('item.index', [
    //         'items' => $items,
    //     ]);
    // }

    public function index(Request $request)
    {
        // 商品一覧取得
        $items = Item::orderBy('id', 'asc')->paginate(10);

         /* キーワードから検索処理 */
         // 任意の変数に受け取った送信された情報を代入します
         // htmlのinputタグにはname属性に対して'keyword'と設定されているため
         // $keywordへ$requestの中から、nameが'keyword'のinputを代入

         $keyword = $request->input('keyword');
         $keyword2 = $request->input('keyword2');
         if(!empty($keyword)) { //$keywordの中身が空ではない場合に検索処理を実行
            $items = Item::where('name', 'LIKE', "%".$keyword."%")->orWhere('author', 'LIKE', "%".$keyword."%")->orwhere('price', 'LIKE', "%".$keyword."%")->paginate(10);
         } 
            elseif (!empty($keyword2)) {
                $items = Item::where('type', '=', $keyword2)->paginate(10);
         }

         return view('item.index', [
                    'items' => $items,
        ]);
    }

    /**
     * 商品登録画面
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type'=> 'required | integer',
                'author'=> 'max:50',
                'price'=> 'nullable | integer',
                'datail'=> 'max:500',
            ],
            [
                'name.required' => 'タイトルは必須です。',
                'type.required' => 'ジャンルを選択して下さい。',
                'author.max: 50' => '著者は50文字以内で入力して下さい。',
                'price.integer' => '価格は数字で入力して下さい。',
                'detail.max: 500' => '詳細は500文字以内で入力して下さい。',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'author' => $request->author,
                'price' => $request->price,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品詳細画面
     * 
     */
    public function detail(Request $request) {
        // 一覧画面で指定された商品IDのレコードを取得
        $item = Item::where('id', '=', $request->id)->first();

        return view('item.detail')->with([
            'item' => $item,
        ]);
    }

    /**
     * 商品情報編集画面
     * 
     */
    public function edit(Request $request) {
        // 一覧画面で指定された商品IDのレコードを取得して表示
        $item = Item::where('id', '=', $request->id)->first();

        return view('item.edit')->with([
            'item' => $item,
        ]);
    }

    // 商品情報更新
    public function update(Request $request) {
        // validation
        $this->validate($request, [
            'name'=> 'required | max:100',
            'type'=> 'required | integer',
            'author'=> 'max:50',
            'price'=> 'nullable | integer',
            'datail'=> 'max:500',
        ],
        [
            'name.required' => 'タイトルは必須です。',
            'name.max:100' => '商品名は100文字以内で入力してください。',
            'type' => 'ジャンルは必須です。',
            'author.max:50' => '著者は50文字以内で入力してください。',
            'price.integer' => '価格は数値で入力してください。',
            'detail.max:500' => '詳細は500文字以内で入力してください。'
        ]);

        $item = Item::where('id', '=', $request->id)->first();

        $item->name = $request->name;
        $item->type = $request->type;
        $item->author = $request->author;
        $item->price = $request->price;
        $item->detail = $request->detail;

        $item->save();

        return redirect('/items');
    }

    // 商品情報削除
    public function delete(Request $request) {
        $item = Item::where('id', '=', $request->id)->first();
        $item->delete();

        return redirect('/items');
    }


    
}

