@extends('layout.app')

@section('contents')
    <h1>菜品添加</h1>
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <script type="text/javascript" src="/webuploader/jquery.js"></script>
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('layout._errors')
    <form method="post" action="{{route('menus.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">名称</label>
            <input type="text" class="form-control" name="goods_name" placeholder="请输入名称" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">价格</label>
            <input type="number" class="form-control" name="goods_price" placeholder="请输入价格">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">描述</label>
            <input type="text" class="form-control" name="description" placeholder="请输入描述">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">提示信息</label>
            <input type="text" class="form-control" name="tips" placeholder="请输入描述">
        </div>
        {{--<div class="form-group">--}}
            {{--<label>图片上传</label>--}}
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
                <input name="status" type="radio" value="1" />上架
                <input name="status" type="radio" value="0" />下架
            </label>
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
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




