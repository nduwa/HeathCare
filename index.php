<?php
include "includes/auto_load.req.php";
if(isset($_SESSION['message'])){
  $message = $_SESSION['message'];
}else{
  $message = "";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HeathCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* width */
::-webkit-scrollbar {
  width: 5px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #1ABB9C; 
  border-radius: 10px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #b30000; 
}
#card{
  padding: 1rem;
  margin-top: 5rem;
}#form{
  border: solid 0.3rem #0c1e2e;
  padding: 2rem;
  border-radius:2rem;
  font-size: 1.3rem;
}
</style>
  <body>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4" id="card">
                
                <form action="router/action_page" method="post" id="form">
                  <h1 class="text-center">DG Health</h1>
                  <hr>
                  
                    <?php echo $message; ?>
                  
                    <div class="mb-3">
                      <label for="username" class="form-label">Username address</label>
                      <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required" autofocus="autofocus">
                    </div>
                    <div class="text-center">
                      <input type="submit" class="btn btn-dark form-control" name="login_button" value="login" >
                    </div>
                    <hr>
                    <div class="text-center">
                      &copy; Copyright Reserved 2019-<?php echo date("Y"); ?> by <a href="/">FreedomLife</a>
                    </div>
                </form>
                  
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>