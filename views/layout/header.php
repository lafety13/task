<!DOCTYPE html>
<!-- saved from url=(0048)http://bootstrap-3.ru/examples/starter-template/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="http://bootstrap-3.ru/assets/ico/favicon.ico">

    <title>Unstoppable</title>

    <!-- Bootstrap core CSS -->
    <link href="/tamplate/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/tamplate/css/starter-template.css" rel="stylesheet">
    <script src="/tamplate/js/jquery.min.js"></script>
    <script src="/tamplate/js/ajax.js"></script>

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.php">Don't tuch</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <!--<li class="active"><a href="index.php">Sign in</a></li> -->

            <li><a href="feedback">Feedback</a></li>
            <?php if (User::isGuest()): ?>
              <li><a href="/login">Sign in</a></li>
            <?php else:?>
              <li><a href="/cabinet">Cabinet</a></li>
              <li><a class="" href="/logout">Logout</a></li>
            <?php endif;?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>