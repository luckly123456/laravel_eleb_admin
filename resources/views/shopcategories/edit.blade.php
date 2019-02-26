@extends('layout.app')

@section('contents')
    <h1>修改分类</h1>
    @include('layout._errors')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <script type="text/javascript" src="/webuploader/jquery.js"></script>
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <form method="post" action="{{route('shopcategories.update',[$shopcategorie])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{method_field('patch')}}
        <div class="form-group">
            <label for="exampleInputEmail1">分类名</label>
            <input type="text" class="form-control" name="name" value="{{$shopcategorie->name}}">
        </div>
        <div class="form-group">
            <label>分类状态:
                <input name="status" type="radio" value="1" @if(old('status')??$shopcategorie->status==1) checked @endif/>上架
                <input name="status" type="radio" value="0" @if(old('status')??$shopcategorie->status==0) checked @endif/>下架
            </label>
        </div>
        {{--<div class="form-group">--}}
            {{--<label>图片上传</label>--}}
            {{--<img src="{{\Illuminate\Support\Facades\Storage::url($shopcategorie->img)}}" alt="">--}}
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
            server: '/shopcateupload',
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



