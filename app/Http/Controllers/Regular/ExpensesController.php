<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpensesController extends Controller
{
    public function add()
    {
        return view('regular.expenses.create');
    }

   public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Expenses::$rules);
        
        // モデルのインスタンスを生成する
        $Expenses = new Expenses;
        // リクエストのパラメーターを連想配列に変換して$formに入れる
        $form = $request->all();
    
        // 不要なパラメーターを削除する
        unset($form['_token']);
        unset($form['image']);
        
        // データベースに保存する
        $Expenses->fill($form);
        $Expenses->save();
    
        return redirect('regular/calendar');
    }
}
