<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Event;

class EventController extends Controller
{
    public function add()
    {
        return view('regular.event.create');
    }

    public function show(Request $request)
    {
    $event = Event::find($request->id);
      if (empty($event)) {
        abort(404);    
      }
      return view('regular.event.show', ['form' => $event]);
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
        $Event->user_id = Auth::id();
        $Event->fill($form);
        $Event->save();
    
        return redirect('regular/calendar');
    }

    public function edit(Request $request)
  {
      // News Modelからデータを取得する
      $data = Event::find($request->id);
      if (empty($data)) {
        abort(404);    
      }
      return view('regular.event.edit', ['form' => $data]);
  }

  public function update(Request $request)
  {
      // Validationをかける
      $this->validate($request, Event::$rules);
      // News Modelからデータを取得する
      $event = Event::find($request->id);
      // 送信されてきたフォームデータを格納する
      $event_form = $request->all();
      unset($event_form['_token']);

      // 該当するデータを上書きして保存する
      $event->fill($event_form)->save();

      return redirect('regular/calendar/');
  }
  
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $event = Event::find($request->id);
      // 削除する
      $event->delete();
      return redirect('regular/calendar/');
  }
}