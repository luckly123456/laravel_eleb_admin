@extends('layout.app')

@section('contents')
    <h1>商家添加</h1>
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <script type="text/javascript" src="/webuploader/jquery.js"></script>
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    @include('layout._errors')
    <form method="post" action="{{route('shops.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleInputEmail1">店铺名称</label>
            <input type="text" class="form-control" name="shop_name" placeholder="请输入店铺名">
        </div>
        <div class="form-group">
            <label>所属分类</label>
            <select name="shop_category_id" class="form-control" style="width: 200px">
                @foreach($shopcategories as $shopcategorie)
                    <option value="{{ $shopcategorie->id }}"
                            @if(old('$shopcategorie')==$shopcategorie->id) selected @endif
                    >{{ $shopcategorie->name }}</option>
                @endforeach
            </select>
        </div>


        {{--<div class="form-group">--}}
            {{--<label>店铺图片</label>--}}
            {{--<input type="file" name="shop_img">--}}
        {{--</div>--}}
        <div class="form-group">
            <label>店铺图片</label>
            <input type="hidden" name="img" id="img_val">
            <div id="uploader-demo">
                <!--用来存放item-->
                <div id="fileList" class="uploader-list"></div>
                <div id="filePicker">选择图片</div>
                <img src="" id="img" width="100"/>
            </div>

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">评分</label>
            <input type="number" class="form-control" name="shop_rating" placeholder="请输入店铺名">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否是品牌</label>
            <input name="brand" type="radio" value="1" />是
            <input name="brand" type="radio" value="0" />否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否准时送达</label>
            <input name="on_time" type="radio" value="1" />是
            <input name="on_time" type="radio" value="0" />否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否蜂鸟配送</label>
            <input name="fengniao" type="radio" value="1" />是
            <input name="fengniao" type="radio" value="0" />否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否保标记</label>
            <input name="bao" type="radio" value="1" />是
            <input name="bao" type="radio" value="0" />否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	是否票标记</label>
            <input name="piao" type="radio" value="1" />是
            <input name="piao" type="radio" value="0" />否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">是否准标记</label>
            <input name="zhun" type="radio" value="1" />是
            <input name="zhun" type="radio" value="0" />否
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">起送金额</label>
            <input type="number" class="form-control" name="start_send" placeholder="请输入店铺名">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">配送费</label>
            <input type="number" class="form-control" name="send_cost" placeholder="请输入店铺名">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">店公告</label>
            <input type="text" class="form-control" name="notice" placeholder="请输入店铺名">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">优惠信息</label>
            <input type="text" class="form-control" name="discount" placeholder="请输入店铺名">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">	状态</label>
            <input name="status" type="radio" value="1" />正常
            <input name="status" type="radio" value="0" />禁用
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



