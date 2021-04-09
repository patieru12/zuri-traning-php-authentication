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
    </style>

    
    <!-- CSS for Toastr notification -->
    <link rel="stylesheet" type="text/css" href="./assets/toastr/toastr.css" />
    <!-- Custom styles for this template -->
    <link href="./signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form id="login_form" method="POST" action="login.php">
        <img class="mb-4" src="./assets/images/login_icon.png" alt="">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="form-floating">
          <input type="text" name="username" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
        <button class="w-100 btn btn-sm btn-primary" id="submit_form" type="submit">Sign in</button>
        <p class="mt-2 mb-1 text-muted">Don't have an account. <a href="./register.php">register</a></p>
        <p class="mt-1 mb-3 text-muted">Forgot password. <a href="./reset.php">reset</a></p>
      </form>
    </main>
  </body>
</html>
<script type="text/javascript" src="./assets/dist/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="./assets/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="./assets/toastr/toastr.min.js"></script>
<script type="text/javascript">
  //Here Make sure to submit the login page
  $(document).ready(function(){
    // console.log("The Jquery is ready for use");
    $("#login_form").submit(function(e){
      e.preventDefault(); //to stop the normal form submittion process

      //Now make sure to use ajax and submit the request
      var my_form = $(this);
      var submit_button = $("#submit_form");
      $.ajax({
        type: my_form.attr('method'), //send with post
        url: my_form.attr('action'),  
        data: my_form.serialize(),
        beforeSend: function(){
          submit_button.html('<i class="fas fa-sync fa-spin"></i> Checking...');
          submit_button.attr("disabled", "disabled");
        },
        success: function(response){
          if(response.success){
            // alert("Authentication succeed");
            //Build the Toastr to notify the success
            toastr.success(response.message, 'Authentication', {
                      positionClass: 'toast-top-center',
                      progressBar: true,
                      preventDuplicates: true,
                  });

            setTimeout(function(e){
              window.location = "./" + response.url;
            }, 1000);
          } else {
            toastr.error(response.message, 'Authentication', {
                  positionClass: 'toast-top-center',
                  progressBar: true,
                  preventDuplicates: true,
              });
          }
          submit_button.html("Sign in");
          submit_button.removeAttr("disabled");
        },
        error: function(error){
          // console.log(error);
          toastr.error(error, 'Authentication', {
            positionClass: 'toast-top-center',
            progressBar: true,
            preventDuplicates: true,
          });
          submit_button.html("Sign in");
          submit_button.removeAttr("disabled");
        }
      });
    });
  });
</script>
