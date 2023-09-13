<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * ユーザー一覧
     * 
     * @param Request $request
     * @return Response
     */
    public function users(Request $request) {

        // usersテーブルのレコードを全件取得する
        $users = User::orderBy('id', 'asc')->get();
        return view ('user.index', [
            'user' => $users,
        ]);
    }


    public function edit(Request $request) {
        
        // ユーザー一覧で指定されたIDのレコードを取得する
        $user = User::where('id', '=', $request->id)->first();
        
        return view('user.edit')->with([
            'user' => $user,
        ]);
    }

    // ユーザー情報の更新
    public function update(Request $request) {
        $user = User::where('id', '=', $request->id)->first();

        // dd($request->all());
        if($request->newPassword === $request->newPassword2){
            if (Hash::check($request->password, $user->password)) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->newPassword);
                $user->role = $request->role;
                $user->save();
            } else {
                // error
                echo "現在のパスワードが違っています。";
            } 
        } else {
            echo "新しいパスワードと確認用パスワードは同じ値を入力してください。";
        }



        // ログイン画面にリダイレクト
        return redirect('/login');
    }
}
