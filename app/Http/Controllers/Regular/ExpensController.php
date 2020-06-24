<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Expens;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Config;

class ExpensController extends Controller
{
    public function add()
    {
        $Categories = __('define.expens_category');
        return view('regular.expenses.create',['categories' => $Categories ]);
    }

   public function show(Request $request)
    {
    $expens = Expens::find($request->id);
      if (empty($expens)) {
        abort(404);    
      }
      $Categories = __('define.expens_category');
      return view('regular.expenses.show', ['form' => $expens, 'categories' => $Categories]);
    }
   
   public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Expens::$rules);
        
        // モデルのインスタンスを生成する
        $Expenses = new Expens;
        // リクエストのパラメーターを連想配列に変換して$formに入れる
        $form = $request->all();
    
        // 不要なパラメーターを削除する
        unset($form['_token']);
        unset($form['image']);
        
        // データベースに保存する
        $Expenses->fill($form);
        $Expenses->user_id = Auth::id();
        $Expenses->save();
    
        return redirect('regular/calendar');
    }
    
    public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $data = Expens::find($request->id);
      if (empty($data)) {
        abort(404);    
      }
      $Categories = __('define.expens_category');
      return view('regular.expenses.edit', ['form' => $data, 'categories' => $Categories]);
  }
  
  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Expens::$rules);
      // News Modelからデータを取得する
      $expens = Expens::find($request->id);
      // 送信されてきたフォームデータを格納する
      $expens_form = $request->all();
      unset($expens_form['_token']);

      // 該当するデータを上書きして保存する
      $expens->fill($expens_form)->save();

      return redirect('regular/calendar/');
  }
  
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $expens = Expens::find($request->id);
      // 削除する
      $expens->delete();
      return redirect('regular/calendar/');
  }
}
