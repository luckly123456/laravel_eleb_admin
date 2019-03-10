@extends('layout.app')

@section('contents')
    <h1>菜单添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('navs.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" class="form-control" name="name" placeholder="请输入名称" >
        </div>
        <div class="form-group">
            <label>上一级菜单</label>
            <select name="pid" class="form-control" style="width: 200px">
            @foreach($navs as $nav)
            <option value="{{ $nav->id }}"
            @if(old('pid')==$nav->id) selected @endif
            >{{ $nav->name }}</option>
            @endforeach
            </select>
            </div>
        <div class="form-group">
            <label for="exampleInputEmail1">地址路由</label>
            <input type="text" class="form-control" name="url" placeholder="请输入地址路由">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputEmail1">权限id</label>--}}
            {{--<input type="number" class="form-control" name="permission_id" placeholder="权限id">--}}
        {{--</div>--}}


        <div class="form-group">
            <label>权限id</label>
            <select name="permission_id" class="form-control" style="width: 200px">
                @foreach($permissions as $permission)
                    <option value="{{ $permission->id }}"
                            @if(old('permission_id')==$permission->id) selected @endif
                    >{{ $permission->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>



@stop




