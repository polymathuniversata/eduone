<!DOCTYPE html>
<html ng-app="App">
    <head>
        <title>Uniform @yield('title')</title>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
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
        var APP_URL = 'http://uniform.dev/';

        $(function(){
          $('.dropdown-menu').click(function(e) {
            e.stopPropagation();
          });
        });
        </script>
        @yield('header')
    </head>
    <body>
      
        <div class="container-fluid">
            <div class="row">
                <aside id="sidebar">
                    <header id="header">
                        <h1><a href="/">Uniform</a></h1>

                        <a href="/" class="thumbnail">
                            <img src="{!! App\User::find(1)->getPhoto() !!}" alt="View Profile">
                            <figcaption>Tan Nguyen</figcaption>
                        </a>
                    </header>
                    
                    <nav id="main-menu">
                        <ul class="list-unstyled">
                            <li><a href="/"><i class="glyphicon glyphicon-stats"></i> Overviews</a></li>
                            <li class="active"><a href="/"><i class="glyphicon glyphicon-user"></i> Users</a>
                                <ul class="list-unstyled">
                                    <li><a href="/">Students</a></li>
                                    <li><a href="/">Teachers</a></li>
                                </ul>
                            </li>
                            <li><a href="/"><i class="glyphicon glyphicon-tree-conifer"></i> Classes</a></li>
                            <li><a href="/"><i class="glyphicon glyphicon-time"></i> Class Routines</a></li>
                            <li><a href="/"><i class="glyphicon glyphicon-book"></i> Programs</a></li>
                            <li><a href="/"><i class="glyphicon glyphicon-text-background"></i> Assets</a></li>
                        </ul>
                    </nav>

                    <a href="/sign-out" id="sign-out">Sign Out</a>
                </aside>          
              
                <main id="content">
                    <nav class="navbar navbar-default">
                      <div class="container-fluid">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                          <a class="navbar-brand" href="#">@yield('main_title')</a>
                        </div>

                        <div id="main-button" class="pull-right">@yield('main_button')</div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="navbar-form navbar-right" role="search">
                            @yield('search_box')
                        </div>
                            
                      </div><!-- /.container-fluid -->
                    </nav>
                    
                    <div class="container-fluid">

                        <div class="row">
                            @if (! empty(session('message')))
                                <div class="alert alert-message">
                                    {!! session('message') !!}
                                </div>
                            @endif
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                @yield('content')
                            </div>
                        </div>

                        <div class="row">
                            <footer class="col-md-12">
                                Copyright &copy; 2015 <a href="https://binaty.org">Binaty</a>
                            </footer>
                        </div>
                    </div>
                </main>
            </div><!--.rơ-->
        </div><!--.container-fluid-->

        @yield('footer')
    </body>
</html>
