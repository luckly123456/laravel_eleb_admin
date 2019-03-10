@extends('layout.app')

@section('contents')
    <h1>角色修改</h1>
    @include('layout._errors')
    <form method="post" action="{{route('roles.update',[$role])}}" enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputEmail1">权限名</label>
            <input type="text" class="form-control" name="name" value="{{$role->name}}">
        </div>
        <div>
            @foreach($permissions as $permission)
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"> {{$permission->name}}</label>
            @endforeach

        </div>
        {{ csrf_field() }}
        {{method_field('patch')}}
        <button type="submit" class="btn btn-primary">修改</button>
    </form>

@stop



