@extends('layout.app')

@section('contents')
    <h1>菜品修改</h1>
    <script type="text/javascript" src="/webuploader/jquery.js"></script>
    @include('layout._errors')
    <form method="post" action="{{route('menus.update',[$menu])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" class="form-control" name="goods_name" value="{{$menu->goods_name}}" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">价格</label>
            <input type="number" class="form-control" name="goods_price" value="{{$menu->goods_price}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">描述</label>
            <input type="text" class="form-control" name="description" value="{{$menu->description}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">提示信息</label>
            <input type="text" class="form-control" name="tips" value="{{$menu->tips}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">评分</label>
            <input type="number" class="form-control" name="rating" value="{{$menu->rating}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">月销量</label>
            <input type="number" class="form-control" name="month_sales" value="{{$menu->month_sales}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">评分数量</label>
            <input type="number" class="form-control" name="rating_count" value="{{$menu->rating_count}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">满意度数量</label>
            <input type="number" class="form-control" name="satisfy_count" value="{{$menu->satisfy_count}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">满意度评分</label>
            <input type="number" class="form-control" name="satisfy_rate" value="{{$menu->satisfy_rate}}">
        </div>
        {{--<div class="form-group">--}}
            {{--<label>图片上传</label>--}}
            {{--<img src="{{ $menu->goods_img }}" width="50">--}}
            {{--<input type="file" name="img">--}}
        {{--</div>--}}
        <div class="form-group">
            <label>菜品图片</label>
            <input type="hidden" name="img" id="img_val">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
                <img src="" id="img" width="100"/>
            </div>

        </div>
        <div class="form-group">
            <label>所属分类</label>
            <select name="category_id" class="form-control" style="width: 200px">
                @foreach($menucategories as $menucategorie)
                    <option value="{{ $menucategorie->id }}"
                            @if(old('category_id')==$menucategorie->id) selected @endif
                    >{{ $menucategorie->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>状态:
                <input name="status" type="radio" value="1" @if(old('status')??$menu->status==1) checked @endif/>上架
                <input name="status" type="radio" value="0" @if(old('status')??$menu->status==0) checked @endif/>下架
            </label>
        </div>
        <button type="submit" class="btn btn-primary">修改</button>
    </form>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            //swf: '/js/Uploader.swf',
            // 文件接收服务端。
            server: '/upload',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            //设置上传请求参数
            formData:{
                _token:'{{ csrf_token() }}'
            }
        });
        //监听上传成功事件
        uploader.on( 'uploadSuccess', function( file,response ) {
            // do some things.
            console.log(response.path);
            //图片回显
            $("#img").attr('src',response.path);
            //图片地址写入隐藏域
            $("#img_val").val(response.path);
        });
    </script>
@stop



