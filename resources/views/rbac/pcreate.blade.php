@extends('layout.app')

@section('contents')
    <h1>权限添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('permissions.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">权限名</label>
            <input type="text" class="form-control" name="name" placeholder="请输入权限名">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputEmail1">权限描述</label>--}}
            {{--<input type="text" class="form-control" name="guard_name" placeholder="请输入权限描述">--}}
        {{--</div>--}}
        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



