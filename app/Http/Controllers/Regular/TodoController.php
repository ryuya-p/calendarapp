<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Todo;

class TodoController extends Controller
{
    public function add()
    {
        return view('regular.todo.create');
    }

    public function show(Request $request)
    {
    $todo = Todo::find($request->id);
      if (empty($todo)) {
        abort(404);    
      }
      return view('regular.todo.show', ['form' => $todo]);
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
        $Todo->user_id = Auth::id();
        $Todo->save();
    
        return redirect('regular/calendar');
    }
    
    public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $data = Todo::find($request->id);
      if (empty($data)) {
        abort(404);    
      }
      return view('regular.todo.edit', ['form' => $data]);
  }
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Todo::$rules);
      // News Modelからデータを取得する
      $todo = Todo::find($request->id);
      // 送信されてきたフォームデータを格納する
      $todo_form = $request->all();
      unset($todo_form['_token']);

      // 該当するデータを上書きして保存する
      $todo->fill($todo_form)->save();

      return redirect('regular/calendar');
  }
  
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $todo = Todo::find($request->id);
      // 削除する
      $todo->delete();
      return redirect('regular/calendar/');
  }
}
