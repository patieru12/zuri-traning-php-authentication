<?php
session_start();
if(!isset($_SESSION['user'])){
	header("location:./logout.php");
	exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Authentication Page">
    <meta name="author" content="Ruberandinda Patience">
    <meta name="generator" content="Zuri Trainning">
    <title>Zuri Trainning Task 3 - Authentication Page</title>

    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="apple-touch-icon" href="./assets/images/login_icon.png" />
    <link rel="icon" href="./assets/images/login_icon.png" />

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

      body {
    background-color: #B3E5FC;
    border-radius: 10px
}

.card {
    width: 400px;
    border: none;
    border-radius: 10px;
    background-color: #fff
}

.stats {
    background: #f2f5f8 !important;
    color: #000 !important
}

.articles {
    font-size: 10px;
    color: #a1aab9
}

.number1 {
    font-weight: 500
}

.followers {
    font-size: 10px;
    color: #a1aab9
}

.number2 {
    font-weight: 500
}

.rating {
    font-size: 10px;
    color: #a1aab9
}

.number3 {
    font-weight: 500
}
    </style>

    <!-- CSS for Toastr notification -->
    <link rel="stylesheet" type="text/css" href="./assets/toastr/toastr.css" />

    </head>
  <body class="text-center">
	<div class="container mt-5 d-flex justify-content-center">
	    <div class="card p-3">
	        <div class="d-flex align-items-center">
	            <div class="image"> <img src="./assets/images/logged_in_user.png" class="rounded" width="145"> </div>
	            <div class="ml-3 w-100">
	                <h4 class="mb-0 mt-0"><?= $_SESSION['user'][1] ?></h4> <span><?= $_SESSION['user'][2] ?></span>
	                <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
	                    <div class="d-flex flex-column"> <span class="articles">Articles</span> <span class="number1">0</span> </div>
	                    <div class="d-flex flex-column"> <span class="followers">Followers</span> <span class="number2">0</span> </div>
	                    <div class="d-flex flex-column"> <span class="rating">Rating</span> <span class="number3">0</span> </div>
	                </div>
	                <div class="button mt-2 d-flex flex-row align-items-center"> 
	                	<a href="./logout.php" class="btn btn-sm btn-outline-primary w-100" title="Logout">Logout</a> 
	                	<!-- <button class="btn btn-sm btn-primary w-100 ml-2">Logout</button>  -->
	               	</div>
	            </div>
	        </div>
	    </div>
	</div>
  </body>
</html>
<script type="text/javascript" src="./assets/dist/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./assets/dist/js/bootstrap.bundle.min.js"></script>