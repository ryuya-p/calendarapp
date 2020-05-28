<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TodoController extends Controller
{
    public function add()
    {
        return view('regular.todo.create');
    }

   public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Todo::$rules);
        
        // モデルのインスタンスを生成する
        $Todo = new Todo;
        // リクエストのパラメーターを連想配列に変換して$formに入れる
        $form = $request->all();
    
        // 不要なパラメーターを削除する
        unset($form['_token']);
        unset($form['image']);
        
        // データベースに保存する
        $Todo->fill($form);
        $Todo->save();
    
        return redirect('regular/calendar');
    }
}
