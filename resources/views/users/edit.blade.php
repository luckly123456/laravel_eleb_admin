@extends('layout.app')

@section('contents')
    <h1>修改商家</h1>
    @include('layout._errors')
    <form method="post" action="{{route('users.store',[$user])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">用户名</label>
            <input type="text" class="form-control" name="name" value="{{$user->name}}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">邮箱</label>
            <input type="email" class="form-control" name="email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control" style="width: 200px">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}"
                            @if(old('$shop_id')==$shop->id) selected @endif
                    >{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



