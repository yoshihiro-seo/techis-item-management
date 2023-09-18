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
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view ('user.index', [
            'users' => $users,
        ]);
    }


    public function edit(Request $request) {
        $loginuser = Auth::user();
        //dd($loginuser);
        
        // ユーザー一覧で指定されたIDのレコードを取得する
        $user = User::where('id', '=', $request->id)->first();
        
        return view('user.edit')->with([
            'user' => $user,
            'loginuser' => $loginuser,
        ]);
    }

    // ユーザー情報の更新
    public function update(Request $request) {

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required',

            // 現在のパスワードは、新しいパスワードか確認用のパスワードが入力されていれば必須
            'currentPassword' => 'required_with:newPassword,newPassword2',

            // 新しいパスワードは、現在のパスワードか確認用のパスワードが入力されていれば必須/ ８文字以上で設定すること、文字列であること
            'newPassword' => 'required_with:currentPassword,newPassword2|min:8|string',

            // 確認用のパスワードは、現在のパスワードか新しいパスワードが入力されていれば必須
            'newPassword2' => 'required_with:currentPassword,newPassword',
        ],
        [
            'name.required' => '名前を入力して下さい。',
            'email.required' => 'メールアドレスを入力して下さい。',
            'newPassword.min' => '新しいパスワードは８文字以上で設定して下さい。',

            'currentPassword.required_with' => '①現在のパスワードを入力して下さい。',
            'newPassword.required_with' => '②新しいパスワードを入力して下さい。',
            'newPassword2.required_with' => '③確認用パスワードを入力して下さい。',
        ]);

        $user = User::find($request->id);
        
        if(!$request->filled('currentPassword')){
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
        }
        elseif($request->newPassword === $request->newPassword2){
            if (Hash::check($request->currentPassword, $user->password)) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->newPassword);
                $user->role = $request->role;
                $user->save();
            } else {
                // error
                return redirect()->back()->withErrors("現在のパスワードが違っています。")->withInput();
            } 
        } else {
                return redirect()->back()->withErrors("新しいパスワードと確認用パスワードは同じ値を入力してください。")->withInput();
        }
        // ユーザー一覧画面にリダイレクト
        return redirect('/user');
    }

    // ユーザー削除
    public function delete(Request $request){

        $user = User::where('id', '=', $request->id)->first();
        $user->delete();

        // ユーザー一覧にリダイレクト
        return redirect('/user');
    }


}
