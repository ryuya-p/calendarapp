<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Event;
use App\Expens;
use App\Todo;
use Auth;

class CalendarController extends Controller
{
    public function index()
    {    
        $dt = Carbon::now();
        $dates = $this->getCalendarDates($dt->year, $dt->month);
        $Events = Event::GetIndexRows( $dt->year, $dt->month );        
        $Todos = Todo::where('user_id',Auth::id())->Get();
        $Expenses = Expens::GetIndexRows( $dt->year, $dt->month );
        $def['expens_cat'] = __('define.expens_category');
        $summary = $this->expensSummary($dt->year, $dt->month);
        return view('regular.calendar.index', ['dates' => $dates, 'currentMonth' => $dt->month, 'currentYear' => $dt->year, 'Events' => $Events, 'Expenses' => $Expenses, 'Todos' => $Todos , 'def' => $def, 'summary' => $summary]);
        
    }
    
    public function nextmonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $dt = Carbon::create($year , $month , 1 , 1 , 0 , 0 , 0);
        $dt->addMonth();
        $dates = $this->getCalendarDates($dt->year, $dt->month);
        $Events = Event::GetIndexRows( $dt->year, $dt->month );        
        $Todos = Todo::where('user_id',Auth::id())->Get();
        $Expenses = Expens::GetIndexRows( $dt->year, $dt->month );
        $def['expens_cat'] = __('define.expens_category');
        $summary = $this->expensSummary($dt->year, $dt->month);
        return view('regular.calendar.index', ['dates' => $dates, 'currentMonth' => $dt->month, 'currentYear' => $dt->year, 'Events' => $Events, 'Expenses' => $Expenses, 'Todos' => $Todos, 'def' => $def, 'summary' => $summary ]);
    }
    
    public function prevmonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $dt = Carbon::create($year , $month , 1 , 1 , 0 , 0 , 0);
        $dt->subMonth();
        $dates = $this->getCalendarDates($dt->year, $dt->month);
        $Events = Event::GetIndexRows( $dt->year, $dt->month );        
        $Todos = Todo::where('user_id',Auth::id())->Get();
        $Expenses = Expens::GetIndexRows( $dt->year, $dt->month );
        $def['expens_cat'] = __('define.expens_category');
        $summary = $this->expensSummary($dt->year, $dt->month);
        return view('regular.calendar.index', ['dates' => $dates, 'currentMonth' => $dt->month, 'currentYear' => $dt->year, 'Events' => $Events, 'Expenses' => $Expenses, 'Todos' => $Todos, 'def' => $def, 'summary' => $summary]);
    }
    
    public function getCalendarDates($year, $month)
    {
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($dateStr);
        // カレンダーを四角形にするため、前月となる左上の隙間用のデータを入れるためずらす
        $date->subDay($date->dayOfWeek);
        // 同上。右下の隙間のための計算。
        $count = 31 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
        $dates = [];

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            // copyしないと全部同じオブジェクトを入れてしまうことになる
            $dates[] = $date->copy();
        }
        return $dates;
    }
    
    public function expensSummary($year, $month)
    {
       $rows=Expens::getCategorySummary($year, $month);
       $ret = [];
        foreach( $rows as $v ) {
	        $ret[$v->category_id] = $v->money;
        }
        return $ret;
    }
}