@extends('layout.app')

@section('contents')
    <h1>权限修改</h1>
    @include('layout._errors')
    <form method="post" action="{{route('permissions.update',[$permission])}}" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputEmail1">权限名</label>
            <input type="text" class="form-control" name="name" value="{{$permission->name}}">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputEmail1">权限描述</label>--}}
            {{--<input type="text" class="form-control" name="guard_name" value="{{$permission->guard_name}}">--}}
        {{--</div>--}}
        {{ csrf_field() }}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-primary">修改</button>
    </form>

@stop



