@extends('layouts.admin')

@section('title', '家計簿編集')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>家計簿編集</h2>
                <form action="{{ action('Regular\ExpensController@edit') }}?id={{$form->id}}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">カテゴリー</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ $form->title }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">日時</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="date" value="{{ $form->date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">詳細</label>
                        <div class="col-md-10">
                            <input type="datetime-local" class="form-control" name="notification" value="{{ $form->notification }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">金額</label>
                         <div class="col-md-10">
                            <input type="text" class="form-control" name="place" value="{{ $form->place }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="保存">
                </form>
            </div>
        </div>
    </div
@endsection