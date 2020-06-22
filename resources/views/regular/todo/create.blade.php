@extends('layouts.admin')

@section('title', 'Todo新規作成')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Todo新規作成</h2>
                <form action="{{ action('Regular\TodoController@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">期限</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ old('date') }}">
                            <input type="time" class="form-control" name="hour" value="{{ old('hour') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">通知</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="notification" value="{{ old('notification') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                       <label for="radio01" class="col-md-2">重要</label>
                       <div class="col-md-6">
                          <div class="form-check form-check-inline">
                             <input class="form-check-input" type="radio" name="important" value="○">
                             <label class="form-check-label" for="inlineRadio01">○</label>
                          </div>
                          <div class="form-check form-check-inline">
                             <input class="form-check-input" type="radio" name="important" value="☓" checked="checked">
                             <label class="form-check-label" for="inlineRadio02">☓</label>
                          </div>
                       </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">場所</label>
                         <div class="col-md-10">
                            <input type="text" class="form-control" name="place" value="{{ old('place') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2">メモ</label>
                         <div class="col-md-10">
                            <textarea class="form-control" name="note" rows="20">{{ old('note') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="保存">
                </form>
            </div>
        </div>
    </div
@endsection