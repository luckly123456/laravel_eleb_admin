@extends('layout.app')

@section('contents')
    <h1>修改分类</h1>
    @include('layout._errors')
    <form method="post" action="{{route('menucategories.update',[$menucategorie])}}">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <div class="form-group">
            <label for="exampleInputEmail1">分类名</label>
            <input type="text" class="form-control" name="name" value="{{$menucategorie->name}}">
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
            <input type="text" class="form-control" name="description" value="{{$menucategorie->description}}">
        </div>
        <div class="form-group">
            <label>是否默认分类:
                <input name="is_selected" type="radio" value="1" @if(old('is_selected')??$menucategorie->is_selected==1) checked @endif/>是
                <input name="is_selected" type="radio" value="0" @if(old('is_selected')??$menucategorie->is_selected==0) checked @endif/>否
            </label>
        </div>
        <button type="submit" class="btn btn-primary">修改</button>
    </form>

@stop



