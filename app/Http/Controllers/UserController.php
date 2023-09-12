<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

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
        $user->id = Auth::id();

        if ($user->password === Crypt::encryptString($request->password)) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Crypt::encryptString($request->newPassword);
            $user->role = $request->role;
            $user->save();
        } else {
            // error
        }

        // ログイン画面にリダイレクト
        return redirect('/login');
    }
}
