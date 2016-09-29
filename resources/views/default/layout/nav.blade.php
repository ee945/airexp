<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">{{ env('CONF_SITE_NAME', 'Site Name') }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ url('/') }}">首页</a></li>
            <li><a href="{{ route('hawb_add') }}">分单输入</a></li>
            <li><a href="{{ route('hawb_list') }}">分单列表</a></li>
            <li><a href="{{ route('mawb_list') }}">总单列表</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">统计报表<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">货量统计</a></li>
                <li><a href="#">货源统计</a></li>
                <li><a href="#">每月货量</a></li>
                <li><a href="#">销售分析</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">数据维护<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">地址库</a></li>
                <li><a href="#">目的港</a></li>
                <li><a href="#">客户管理</a></li>
                <li><a href="#">销售管理</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">用户管理</li>
                <li><a href="#">添加用户</a></li>
                <li><a href="#">用户列表</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">系统设定</li>
                <li><a href="#">参数设定</a></li>
                <li><a href="#">制单规则</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>