@extends('layout.app')

@section('contents')
    <h1>角色添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('roles.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">角色名</label>
            <input type="text" class="form-control" name="name" placeholder="请输入角色名">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputEmail1">角色描述</label>--}}
            {{--<input type="text" class="form-control" name="guard_name" placeholder="请输入角色描述">--}}
        {{--</div>--}}
        <div>
            @foreach($permissions as $permission)
            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"> {{$permission->name}}</label>

            @endforeach

        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



