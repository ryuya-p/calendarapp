<?php

namespace App\Http\Controllers\Regular;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {    
        $dt = Carbon::now();
        $dates = $this->getCalendarDates($dt->year, $dt->month);
        return view('regular.calendar.index', ['dates' => $dates, 'currentMonth' => $dt->month, 'currentYear' => $dt->year]);
    }
    public function nextmonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $dt = Carbon::create($year , $month , 1 , 1 , 0 , 0 , 0);
        $dt->addMonth();
        $dates = $this->getCalendarDates($dt->year, $dt->month);
        return view('regular.calendar.index',['dates' => $dates, 'currentYear' => $dt->year, 'currentMonth' => $dt->month]);
    }
    public function prevmonth(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $dt = Carbon::create($year , $month , 1 , 1 , 0 , 0 , 0);
        $dt->subMonth();
        $dates = $this->getCalendarDates($dt->year, $dt->month);
        return view('regular.calendar.index',['dates' => $dates, 'currentYear' => $dt->year, 'currentMonth' => $dt->month]);
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
}