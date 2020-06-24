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
                            <select name="category_id" class="form-control">
                                @foreach($categories as $i => $category)
                                <option value="{{$i}}" @if( $form->category_id == $i ) selected="selected" @endif>{{$category['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">日時</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ $form->date }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">詳細</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="details" rows="20">{{ $form->details }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">金額</label>
                         <div class="col-md-10">
                            <input type="text" class="form-control" name="money" value="{{ $form->money }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="保存">
                </form>
            </div>
        </div>
    </div
@endsection