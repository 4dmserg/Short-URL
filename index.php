<?php
$currentURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parseURL   = str_replace('/','',parse_url($currentURL, PHP_URL_PATH));

if($parseURL){
    $dir   = 'sqlite:base.sqlite';
    $dbh   = new PDO($dir) or die("cannot open the database");
    
    $result = $dbh->query("SELECT * FROM urls WHERE hash = '$parseURL'")->fetchAll(PDO::FETCH_ASSOC);
    
    if(!empty($result)){
        $goToUrl = $result[0]['origin'];
        Header("Location: $goToUrl");
    }
}

?>
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Dmitriy Zakharov">
    <title>Test Work | Short URL</title>

    <!-- Bootstrap core CSS -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    .container {
      width: auto;
      max-width: 680px;
      padding: 0 15px;
    }
    .hidden-block{
        display: none;
    }
    .popover {background-color: #e3ebe2;}
.popover.bottom .arrow::after {border-bottom-color: #e3ebe2; }
.popover-content {background-color: #e3ebe2;}
    </style>

  </head>
  <body class="d-flex flex-column h-100">
    
<!-- Begin page content -->
<main class="flex-shrink-0">
  <div class="container pt-5">
      
    <h1 class="mt-5">Test Work | Short URL</h1>
    <p class="lead">Paste the URL to be shortened</p>
   <!-------------------------->
<div class="input-group mb-3 url-block">
  <input type="text" class="form-control enter-url" placeholder="Enter the link here" aria-label="Enter the link here" aria-describedby="button-addon2">
  <button class="btn btn-outline-dark" type="button" id="button-addon2">Shorten URL</button>
</div>

<div id="spinner" class="row hidden-block">
    <div class="col-12 mb-4 mt-3 text-center">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>   
   
<div class="alert alert-danger alert-dismissible fade show hidden-block" role="alert">
  An invalid URL was entered for a URL field
</div>
   
<div class="input-group mb-3 shortened_URL hidden-block">
    <h3 class="col-12">Your shortened URL</h3>  
  <input type="text" id="shortened_url" class="form-control" value="" aria-describedby="button-addon3">
  <button class="btn btn-outline-primary" type="button" id="button-addon3" data-bs-container="body" data-bs-toggle="popover" 
          data-bs-placement="top" data-bs-content="URL copied">Copy URL</button>
  <h6 class="col-12 mt-4">Long URL:
      <a id="long_url" target="_blank" href=""></a>
  </h6>
</div>
   <!-------------------------->
  </div>
</main>

<footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Footer content here.</span>
  </div>
</footer>

 
  <script src="/assets/js/jquery-3.0.0.min.js" crossorigin="anonymous"></script>
  <script src="/assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>   
  <script src="/assets/js/jquery-migrate-1.4.1.min.js" crossorigin="anonymous"></script>  
  <script src="/assets/js/main.js" crossorigin="anonymous"></script>  
  </body>
</html>
