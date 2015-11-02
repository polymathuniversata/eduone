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

      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="col-md-12">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Uniform</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Dashboard <span class="sr-only">(current)</span></a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="/users">All Users</a></li>
                  <li><a href="/students">Students</a></li>
                  <li><a href="/parents">Parents</a></li>
                  <li><a href="/teachers">Teachers</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/users/create">Add New User</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/roles">Roles &amp; Permissions</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Classes <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="/classes">Classes</a></li>
                  <li><a href="/schedule">Schedule</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Add New Class</a></li>
                </ul>
              </li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Programs <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="/programs">All Programs</a></li>
                  <li><a href="/programs/create">Add New Program</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/subjects">All Subjects</a></li>
                  <li><a href="/subjects/create">Add New Subject</a></li>
                </ul>
              </li>          
              <li><a href="#">Services</a></li>
              
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="/settings">General</a></li>
                  <li><a href="/branches">Branches</a></li>
                  <li><a href="/rooms">Rooms</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/themes">Themes</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="/plugins">Plugins</a></li>
                </ul>
              </li>   
            </ul>
            <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
            </form>
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-cog"></i> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
          </div>
        </div><!-- /.container-fluid -->
      </nav>

        <div class="container">                
          <div id="content" class="col-md-12">
            @if (! empty(session('message')))
              <div class="alert alert-message">
                {!! session('message') !!}
              </div>
            @endif

              @yield('content')
          </div>

          <hr>

          <footer class="col-md-12">
              Copyright &copy; 2015 <a href="https://binaty.org">Binaty</a>
          </footer>
        </div>

        @yield('footer')
    </body>
</html>
