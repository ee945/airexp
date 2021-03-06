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
            <li class="dropdown">
              <a href="{{ route('jincang_list') }}" class="dropdown-toggle">进仓列表<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('jincang_add') }}">进仓登记</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="{{ route('hawb_list') }}" class="dropdown-toggle">分单列表<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('hawb_add') }}">分单输入</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">总单操作</li>
                <li><a href="{{ route('mawb_list') }}">总单列表</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle">统计报表<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('stats_hawb') }}">分单货量</a></li>
              </ul>
            </li>
            <li><a href="{{ route('track_index') }}">货物追踪</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle">数据维护<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ route('contact_list') }}">通讯录</a></li>
                <li><a href="{{ route('address_list') }}">地址库</a></li>
                <li><a href="{{ route('port_list') }}">目的港</a></li>
                <li><a href="{{ route('client_list') }}">客户管理</a></li>
                <li><a href="{{ route('seller_list') }}">销售管理</a></li>
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
          <!-- Right Side Of Navbar -->
          <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (Auth::guest())
              <li><a href="{{ url('/login') }}">登陆</a></li>
              <li><a href="{{ url('/register') }}">注册</a></li>
            @else
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->nick }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li>
                    <a href="#">用户设置</a>
                  </li>
                  <li>
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">注销</a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>