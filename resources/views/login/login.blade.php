@extends('layout.app')

@section('contents')
    <h1>管理员登陆</h1>
    <form method="post" action="{{route('login')}}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="email">用户名：</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="password">密码：</label>
            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
        </div>
        <div class="form-group">
            <label>验证码</label>
            <input type="text" name="captcha" class="form-control" style="width: 200px">
            <img class="thumbnail captcha" src="{{ captcha_src('default') }}" onclick="this.src='/captcha/default?'+Math.random()" title="点击图片重新获取验证码">
        </div>

        <div class="checkbox">
            <label>
                <input type="checkbox" name="rememberMe" value="1">记住我哦
            </label>
        </div>

        <button type="submit" class="btn btn-primary">登录</button>
    </form>

    <hr>

    <p>还没账号？<a href="{{ route('sign') }}">现在注册！</a></p>

@stop



