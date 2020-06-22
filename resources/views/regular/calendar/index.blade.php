@extends('layouts.admin')

@section('title', 'プロフィール作成')

@section('content')

{{ $currentMonth }}
{{ $currentYear }}
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
      <?php $index = "{$currentYear}{$currentMonth}{$date->day}"; ?>
  @if( isset($Events[$index]) && !Empty($Events[$index]) )
     @foreach( $Events[$index] as $node )
  	<div> <a class="btn btn-xs btn-primary" href="/regular/event/show?id={{$node->id}}">{{$node->title}}</a></div>
     @endforeach
  @endif
    
    @if( isset($Todos[$index]) && !Empty($Todos[$index]) )
     @foreach( $Todos[$index] as $node )
  	<div> <a class="btn btn-xs btn-warning" href="/regular/todo/show?id={{$node->id}}">{{$node->title}}</a></div>
     @endforeach
  @endif
  
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
  <a href="{{ action('Regular\CalendarController@prevmonth', ['month' => $currentMonth , 'year' => $currentYear]) }}">前の月</a>
  <a href="{{ action('Regular\CalendarController@nextmonth', ['month' => $currentMonth , 'year' => $currentYear]) }}">次の月</a>
</table>
<div>
  <table>
	<tr>
		<th>項目名</th>
		<th style="text-align:center;">金額</th>
	</tr>
@foreach( __('define.expens_category') as $i => $v )
	<tr>
		<td>{{$v['name']}}</td>
		<td align="right">{{$v['attr']}} {{ number_format( $summary[$i]??0 ) }}円</td>
	</tr>
@endforeach
</table>
</div>
<div style="text-align:center">
  <a class="btn btn-primary" href="/regular/event/create" style="margin-right:60px">予定新規作成</a>
  <a class="btn btn-success" href="/regular/expens/create" style="margin-right:60px">家計簿新規作成</a>
  <a class="btn btn-warning" href="/regular/todo/create">Todo新規作成</a>
    </div>
@endsection