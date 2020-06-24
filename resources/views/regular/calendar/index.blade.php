@extends('layouts.app')

@section('title', 'プロフィール作成')

@section('content')

<div>
  <div style="float:left;">
  <a class="btn btn-primary" href="{{ action('Regular\CalendarController@prevmonth', ['month' => $currentMonth , 'year' => $currentYear]) }}">前の月</a>
  </div>
  <div style="float:right;">
    <a class="btn btn-primary" href="{{ action('Regular\CalendarController@nextmonth', ['month' => $currentMonth , 'year' => $currentYear]) }}">次の月</a>
  </div>
  <div style="width:300px;margin-right:auto;margin-left:auto;font-size:32px">
    {{ $currentYear }}年
    {{ $currentMonth }}月
  </div>
</div>

<table class="table table-bordered">
  <thead>
    <tr>
      @foreach (['日', '月', '火', '水', '木', '金', '土'] as $dayOfWeek)
      <th width="10%">{{ $dayOfWeek }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach ($dates as $date)
    @if ($date->dayOfWeek == 0)
    <tr>
    @endif
      <td
        @if ($date->month != $currentMonth)
        class="bg-secondary"
        @endif
      >
        {{ $date->day }}
      <?php $index = "{$date->year}{$date->month}{$date->day}"; ?>
  @if( isset($Events[$index]) && !Empty($Events[$index]) )
     @foreach( $Events[$index] as $node )
  	<div> <a class="btn btn-xs btn-primary" href="/regular/event/show?id={{$node->id}}">{{$node->title}}</a></div>
     @endforeach
  @endif
    
    {{--@if( isset($Todos[$index]) && !Empty($Todos[$index]) )
     @foreach( $Todos[$index] as $node )
  	<div> <a class="btn btn-xs btn-warning" href="/regular/todo/show?id={{$node->id}}">{{$node->important}} {{$node->title}}</a></div>
     @endforeach
  @endif--}}
  
  @if( isset($Expenses[$index]) && !Empty($Expenses[$index]) )
     @foreach( $Expenses[$index] as $node )
  	<div> <a class="btn btn-xs btn-success" href="/regular/expens/show?id={{$node->id}}">{{$def['expens_cat'][$node->category_id]['attr'] ?? "" }} {{number_format($node->money)}}</a></div>
     @endforeach
  @endif
      </td>
    @if ($date->dayOfWeek == 6)
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
<div style="text-align:center">
  <a class="btn btn-primary" href="/regular/event/create" style="margin-right:60px">予定新規作成</a>
  <a class="btn btn-success" href="/regular/expens/create" style="margin-right:60px">家計簿新規作成</a>
  <a class="btn btn-warning" href="/regular/todo/create">Todo新規作成</a>
</div>
<div style="float:left;width:300px;border:1px solid black">
  <?php $total = 0; ?>
  <table>
	  <tr>
		  <th width=150>項目名</th>
		  <th width=150 style="text-align:center;">金額</th>
	  </tr>
@foreach( __('define.expens_category') as $i => $v )
    @if( !$loop->last  )<tr style="border-bottom:1px solid black">@else <tr style="border-bottom:2px double black">@endif
		  <td>{{$v['name']}}</td>
		  <td align="right">{{$v['attr']}} {{ number_format( $summary[$i]??0 ) }}円</td>
		  <?php if( $v['attr'] == '-' ) $total -= $summary[$i]??0; else $total += $summary[$i]??0; ?>
	  </tr>
@endforeach
<tr><td>合計</td><td align="right">{{number_format($total)}}円</td></tr>
  </table>
</div>
  <div style="float:right;width:300px;border:1px solid black">
  todo
  <ul>
  @foreach($Todos as $data)
  <li><a href="/regular/todo/show?id={{$data->id}}">{{$data->title}}</a></li>
  @endforeach
  </ul>
</div>
@endsection