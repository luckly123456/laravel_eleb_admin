<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>--}}
                <li><a href="#">Link</a></li>


                {{--<?php--}}
                {{--header("content-type:text/html;charset=utf-8");--}}
                {{--$link = mysqli_connect("127.0.0.1","root","root","eleb") or die("链接数据出错");--}}
                {{--$aa = mysqli_query($link,"set names utf8");--}}
                {{--$sql = "select * from navs where pid=1";--}}
                {{--$result = mysqli_query($link,$sql);--}}
                {{--while($row = mysqli_fetch_array($result)){--}}
                {{--?>--}}

                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $row['name'] ?><span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<?php--}}
                {{--$sql1 = "select * from navs where pid=$row->id";--}}
                {{--$result1 = mysqli_query($link,$sql1);--}}
                {{--while($row1 = mysqli_fetch_array($result1)){ ?>--}}
                {{--?>--}}
                {{--@foreach($v as $nav)--}}
                {{--<li><a href="<?php echo $nav->url;?>"><?php echo $nav->name;?></a></li>--}}
                {{--@endforeach--}}
                {{--</ul>--}}
                {{--</li>--}}

                {{--<?php--}}

                {{--}--}}
                {{--?>--}}







                <?php
                header("content-type:text/html;charset=utf-8");
                $link = mysqli_connect("127.0.0.1", "root", "root", "eleb") or die("链接出错");
                mysqli_query($link, "set names utf8");
                $sql = "select * from navs where pid=1";
                $result = mysqli_query($link, $sql);
                while($row = mysqli_fetch_assoc($result)):
                var_dump($row);
                ?>
                <ul class="nav navbar-nav">
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false"><?=$row['name']?><span class="caret"></span></a>
                <ul class="dropdown-menu">
                <?php
                $sq = "select * from navs where pid=" . $row['id'];
                $resul = mysqli_query($link, $sq);
                while($res = mysqli_fetch_assoc($resul)):
                ?>
                @if(auth()->user())
                @if(auth()->user()->can($res['url']))
                <li><a href="{{route($res['url'])}}"><?=$res['name']?></a></li>
                @endif
                @endif
                <?php
                endwhile;
                ?>
                </ul>
                </li>
                </ul>
                <?php
                endwhile;
                ?>







                @foreach($navs as $k=>$v)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$k}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            @foreach($v as $nav)
                                <li><a href="{{route($nav->url)}}">{{$nav->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach


                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">用户管理 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{route('shopcategories.index')}}">商家分类</a></li>--}}
                {{--<li><a href="{{route('shops.index')}}">商家信息</a></li>--}}
                {{--<li><a href="{{route('users.index')}}">商家</a></li>--}}
                {{--<li><a href="{{route('users.audit')}}">商家审核</a></li>--}}
                {{--<li><a href="{{route('admins.index')}}">管理员</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">商品管理 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{route('menucategories.index')}}">商品分类</a></li>--}}
                {{--<li><a href="{{route('menus.index')}}">商品</a></li>--}}
                {{--<li><a href="{{route('activitys.index')}}">活动</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RBAC <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{route('roles.create')}}">添加角色</a></li>--}}
                {{--<li><a href="{{route('roles.index')}}">角色列表</a></li>--}}
                {{--<li><a href="{{route('permissions.create')}}">添加权限</a></li>--}}
                {{--<li><a href="{{route('permissions.index')}}">权限列表</a></li>--}}

                {{--</ul>--}}
                {{--</li>--}}

                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜单 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{route('navs.index')}}">菜单列表</a></li>--}}
                {{--<li><a href="{{route('navs.create')}}">添加菜单</a></li>--}}

                {{--</ul>--}}
                {{--</li>--}}
                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">会员管理 <span class="caret"></span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                {{--<li><a href="{{route('members.index')}}">会员</a></li>--}}
                {{--</ul>--}}
                {{--</li>--}}
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="{{route('login')}}">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-user"></span>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">个人中心</a></li>
                        <li><a href="#">修改密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{route('logout')}}">退出登录</a></li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>