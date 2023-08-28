<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sacred tours and travels</title>
     
    <?php include_once('includes/links.php'); ?>

    <link rel="stylesheet" href="css/login.css">
    

</head>
<body> 
    <?php include_once('includes/navbar.php'); ?>
    
    <?php

    include 'dbcon.php';

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $email_search = " select * from registeration where email = '$email' ";
        $query = mysqli_query($con, $email_search);

        $email_count = mysqli_num_rows($query);

        if($email_count>0){
          $email_pass = mysqli_fetch_assoc($query);

          $db_pass = $email_pass['password'];


          $_SESSION['fname'] = $email_pass['fname'];

          $pass_decode = password_verify($password, $db_pass);

          if($pass_decode){
              ?>
                 <script>
                         location.replace("user.php");
                         alert("Login Successfull");
                       
                  </script>
              <?php
          }else{
              ?>
                 <script>
                       alert("Incorrect Password");
                  </script>
              <?php
          }
        }else{
          ?>
                 <script>
                       alert("Invalid Email");
                  </script>
              <?php
        }

    }
    ?>


<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">User Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>
              <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
              <div class="form-outline form-white mb-4">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Enter your Email"/>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Enter Password"/>
              </div>

              <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

              <button class="btn btn-outline-light btn-lg px-5" type="submit" name="submit">Login</button>

             

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="admin/index.php" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div>
           </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>
</html>
