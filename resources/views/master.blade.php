<!DOCTYPE html>
<html ng-app="App">
    <head>
        <title>@yield('title') - {{Setting::get('title', null, true)}}</title>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="/assets/css/typicons.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/app.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/assets/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
        <script type="text/javascript" src="https://code.angularjs.org/1.4.7/angular-resource.min.js"></script>
        <script type="text/javascript" src="/assets/js/ui-bootstrap-tpls-0.14.3.min.js"></script>
        <script type="text/javascript" src="/assets/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/assets/js/sortable.js"></script>
        <script type="text/javascript" src="/assets/js/tg.dynamic.directive.js"></script>
        <script type="text/javascript" src="/assets/js/app.js"></script>
        <script type="text/javascript">
        var APP_URL = '{{url('/')}}/';
        // before loading pace.js
        window.paceOptions = {
          target: 'main'
        };
        </script>
        <script type="text/javascript" src="/assets/js/pace.min.js"></script>
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        @yield('header')
    </head>
    <body>
      
        <div class="container-fluid" id="wrapper">
            <div class="row row-offcanvas row-offcanvas-left">
                <aside id="sidebar" class="sidebar-offcanvas">
                    <header id="header">
                        <h1><a href="{{url('/')}}">
                            @if (Setting::get('logo', null, true))
                                <img src="{{url('/')}}/images/{{Setting::get('logo', null, true)}}" alt="Logo">
                            @else
                                {{Setting::get('title', null, true)}}
                            @endif
                        </a></h1>
                    </header>
                    
                    <nav id="main-menu">
                        {!! App\Menu::render() !!}
                    </nav>
                </aside>          
              
                <main id="main">
                    
                    <button type="button" class="btn btn-default btn-offcanvas visible-sm visible-xs" data-toggle="offcanvas"><i class="fa fa-bars"></i></button>
                    
                    <nav id="navbar-top" class="navbar navbar-default">
                      <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <span class="navbar-brand">@yield('main_title')</span>
                        </div>

                        <div id="main-button">@yield('main_button')</div>

                        <ul class="nav navbar-nav navbar-right">
                            @if (Auth::user()->isSuperAdmin())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="typcn typcn-flow-children"></i> <strong>{{App\Branch::current()['name']}}</strong> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header">Switch to another branch</li>
                                    @foreach(App\Branch::pluck('name', 'id') as $id => $name)
                                        @if (0 != App\Branch::currentId())
                                        <li><a class="text-small" href="{{url('/')}}/branches/switch/0">Master</a></li>
                                        @endif
                                        @if ($id != App\Branch::currentId())
                                        <li><a class="text-small" href="{{url('/')}}/branches/switch/{{$id}}">{{$name}}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                            @endif

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <img src="{!! Auth::user()->photo !!}" width="20" height="20" alt="{{ Auth::user()->display_name }}"> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-header">Signed in as <strong>{{ Auth::user()->display_name }}</strong></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{url('/profile')}}">My Profile</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{url('/logout')}}">Sign out</a></li>
                                </ul>
                            </li>
                        </ul>

                       <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="navbar-form navbar-right" role="search">
                            @yield('search_box')
                        </div>
                            
                      </div><!-- /.container-fluid -->
                    </nav>

                    <div class="container-fluid">
                        
                        @include('_partials/messages')

                        <section class="row" id="content">
                            <div class="col-md-12">
                                @yield('content')
                            </div>
                        </section>

                        @include('_partials/footer')
                    </div>
                </main>
            </div><!--.row-->
        </div><!--.container-fluid-->

        @yield('footer')
    </body>
</html>
