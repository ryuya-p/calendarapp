@extends('layouts.admin')

@section('title', '家計簿詳細')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>家計簿詳細</h2>
                <form>

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
                            <select name="category_id" class="form-control" disabled="true">
                                @foreach($categories as $i => $category)
                                <option value="{{$i}}" @if( $form->category_id == $i ) selected="selected" @endif>{{$category['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">日時</label>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="date" value="{{ $form->date }}" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">詳細</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="details" rows="20" readonly>{{ $form->details }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">金額</label>
                         <div class="col-md-10">
                            <input type="text" class="form-control" name="money" value="{{ $form->money }}" readonly>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div style="text-align:right;">
                    <a href="/regular/expens/edit?id={{$form->id}}" class="btn btn-primary">編集</a>
                    <a href="/regular/expens/delete?id={{$form->id}}" class="btn btn-alert"　onclick=" if( confirm('削除しますか?') ) return ture; else return false;">削除</a>
                    </div>
                </form>
            </div>
        </div>
    </div
@endsection