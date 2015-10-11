<!DOCTYPE html>
<html>
    <head>
        <title>Uniform @yield('title')</title>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/app.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/assets/js/jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
        @yield('header')
    </head>
    <body>
        <div class="container-fluid">
            <aside class="col-md-2" id="sidebar">
                @section('sidebar')
                    <div class="list-group">
                      <a href="/" class="list-group-item active">
                        Dashboard
                      </a>
                      <a href="/students" class="list-group-item">Students</a>
                      <a href="/teachers" class="list-group-item">Teachers</a>
                      <a href="/parents" class="list-group-item">Parents</a>
                      <a href="/activities" class="list-group-item">Activities</a>
                      <a href="#" class="list-group-item">Attendances</a>
                      <a href="#" class="list-group-item">Grades</a>
                      <a href="/rooms" class="list-group-item">Rooms</a>
                      <a href="#" class="list-group-item">Classes</a>
                      <a href="#" class="list-group-item">Plugins</a>
                      <a href="#" class="list-group-item">Themes</a>
                      <a href="#" class="list-group-item">Payments</a>
                      <a href="#" class="list-group-item">Transport</a>
                      <a href="#" class="list-group-item">Dormitories</a>
                      <a href="#" class="list-group-item">Messages</a>
                      <a href="#" class="list-group-item">Services</a>
                      <a href="#" class="list-group-item">Menus</a>
                      <a href="#" class="list-group-item">Media</a>
                      <a href="#" class="list-group-item">Library</a>
                      <a href="/users" class="list-group-item">{!! trans('app.users') !!}</a>
                      <a href="/groups" class="list-group-item">{!! trans('app.groups') !!}</a>
                      <a href="/branches" class="list-group-item">{!! trans('app.branches') !!}</a>
                      <a href="/settings" class="list-group-item">{!! trans('app.settings') !!}</a>
                    </div>
                @show
            </aside>

            <div id="main" class="col-md-10">
                
                <div id="content" class="col-md-12">
                    @yield('content')
                </div>

                <hr>

                <footer class="col-md-12">
                    Copyright &copy; 2015 <a href="https://binaty.org">Binaty</a>
                </footer>
            </div>
        </div>

        @yield('footer')
    </body>
</html>
