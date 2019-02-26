@extends('layout.app')

@section('contents')
    <h1>商品分类添加</h1>
    @include('layout._errors')
    <form method="post" action="{{route('menucategories.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">分类名</label>
            <input type="text" class="form-control" name="name" placeholder="请输入分类名" >
        </div>
        <div class="form-group">
            <label>所属商家</label>
            <select name="shop_id" class="form-control" style="width: 200px">
                @foreach($shops as $shop)
                    <option value="{{ $shop->id }}"
                            @if(old('$shop')==$shop->id) selected @endif
                    >{{ $shop->shop_name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">描述</label>
            <input type="text" class="form-control" name="description" placeholder="请输入分类名">
        </div>
        <div class="form-group">
            <label>是否默认分类:
                <input name="is_selected" type="radio" value="1" />是
                <input name="is_selected" type="radio" value="0" />否
            </label>
        </div>

        <button type="submit" class="btn btn-primary">添加</button>
    </form>

@stop



