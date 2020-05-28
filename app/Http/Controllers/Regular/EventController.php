<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;

class EventController extends Controller
{
    public function add()
    {
        return view('regular.event.create');
    }

    public function create(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Event::$rules);
        
        // モデルのインスタンスを生成する
        $Event = new Event;
        // リクエストのパラメーターを連想配列に変換して$formに入れる
        $form = $request->all();
    
        // 不要なパラメーターを削除する
        unset($form['_token']);
        unset($form['image']);
        
        // データベースに保存する
        $Event->fill($form);
        $Event->save();
    
        return redirect('regular/event/create');
    }
}
