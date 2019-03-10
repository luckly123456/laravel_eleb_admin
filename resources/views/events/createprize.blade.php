@extends('layout.app')

@section('contents')
    <h1>奖品添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('events.prize',[$event])}}">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <div class="form-group">
            <label for="exampleInputEmail1">奖品</label>
            <input type="text" class="form-control" name="name" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">详情</label>
            <input type="text" class="form-control" name="description">
        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



