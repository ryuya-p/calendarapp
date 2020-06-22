@extends('layouts.admin')

@section('title', '予定詳細')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>予定詳細</h2>
                <form>

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
                            <input type="text" class="form-control" name="title" value="{{ $form->title }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">日時</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ $form->date }}" readonly>
                            <input type="time" class="form-control" name="hour" value="{{ $form->hour }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">通知</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="notification" value="{{ str_replace(" ", "T", $form->notification) }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">場所</label>
                         <div class="col-md-10">
                            <input type="text" class="form-control" name="place" value="{{ $form->place }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">メモ</label>
                         <div class="col-md-10">
                            <textarea class="form-control" name="note" rows="20" readonly>{{ $form->note }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div style="text-align:right;">
                    <a href="/regular/event/edit?id={{$form->id}}" class="btn btn-primary">編集</a>
                    <a href="/regular/event/delete?id={{$form->id}}" class="btn btn-alert"　onclick=" if( confirm('削除しますか?') ) return ture; else return false;">削除</a>
                    </div>
                </form>
            </div>
        </div>
    </div
@endsection