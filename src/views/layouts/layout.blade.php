<!DOCTYPE html>
<html>
  <head>
    <title>File Server</title>
    <link href="/css/jquery-ui.min.css" rel="stylesheet">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('header')
  </head>
  <body>       
    <div class="container-fluid">
      <div class="row">
	<div class="col-md-2 well">
	  <div class="navbar-collapse">
	    @yield('left-nav-bar')
	  </div>
	</div>      
	<div class="col-md-9  well">
	  @yield('content')
	</div>
      </div>
  </body>
</html>
