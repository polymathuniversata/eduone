<!DOCTYPE html>
<html ng-app="App">
    <head>
        <title>EduOne @yield('title')</title>
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

        @yield('header')
    </head>
    <body>
      
        <div class="container-fluid" id="wrapper">
                        
            @include('_partials/messages')

            <section class="row" id="content">
                <div class="col-md-12">
                    @yield('content')
                </div>
            </section>

        </div><!--.container-fluid-->

        @yield('footer')
    </body>
</html>