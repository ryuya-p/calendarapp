<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'title' => 'required',
        'date' => 'required',
    );

        /**
     * カレンダーに表示するデータを取得する
     */
    public static function GetIndexRows( $year, $month ) {
    	//処理月の最初の日付
    	$target_begin_date = "{$year}/{$month}/1";
    	//処理月の最終日を取得
    	$last_day = date('t', strtotime( $target_begin_date ));
    	$target_end_date = "{$year}/{$month}/{$last_day}";
    
    	//処理月の対象データを取得
    	$rows = \DB::table( 'events')
    		//処理月の開始日
    		->where( 'date', '>=', $target_begin_date )
    		//処理月の終了日
    		->where( 'date', '<=', $target_end_date )
    		//削除フラグ
    		//->where(  'alive', 1)
    		->get();
    	/*
    	$rows = self::where( 'date', '>=', $target_begin_date )
    		//処理月の終了日
    		->where( 'date', '<=', $target_end_date )
    		//削除フラグ
    		->where(  'alive', 1)
    		->get();
    	*/
    	
    	//関数の返却変数
    	$ret = [];
    
    	//日付をキーとした連想配列を生成
    	foreach( $rows as $r ) {
    		$r_time = strtotime($r->date);
    		//https://www.php.net/manual/ja/function.date.php
    		$index = date('Ynj', $r_time);
    		$ret[$index][] = $r;
    	}
    
    	return $ret;
    }
}