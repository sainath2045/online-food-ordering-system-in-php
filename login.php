<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>login</title>
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/login.css">

	  <style type="text/css">
	  #buttn{
		  color:#fff;
		  background-color: #ff3300;
	  }
	  </style>
  
</head>

<body>
<?php
include("connection/connect.php"); // INCLUDE CONNECTION
error_reporting(0); // HIDE UNDEFINE INDEX ERRORS
session_start(); // TEMP SESSIONS

if(isset($_POST['submit'])) { // IF BUTTON IS SUBMIT
    $username = $_POST['username']; // FETCH RECORDS FROM LOGIN FORM
    $password = $_POST['password'];

    if(!empty($_POST["submit"])) { // IF RECORDS WERE NOT EMPTY

        // USE PREPARED STATEMENTS TO AVOID SQL INJECTION
        $loginquery = "SELECT u_id, password FROM users WHERE username=?";
        $stmt = $db->prepare($loginquery);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            // USE PASSWORD_VERIFY TO COMPARE PASSWORDS (USING BCRYPT)
            if (password_verify($password, $hashed_password)) {
                $_SESSION["user_id"] = $user_id; // PUT USER ID INTO TEMP SESSION
                header("refresh:1;url=index.php"); // REDIRECT TO INDEX.PHP PAGE
            } else {
                $message = "Invalid Username or Password!"; // THROW ERROR
            }
        } else {
            $message = "Invalid Username or Password!"; // THROW ERROR
        }

        $stmt->close();
    }
}
?>

  
<!-- Form Mixin-->
<!-- Input Mixin-->
<!-- Button Mixin-->
<!-- Pen Title-->
<div class="pen-title">
  <h1>Login Form</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
  <div class="toggle">
   
  </div>
  <div class="form">
    <h2>Login to your account</h2>
	  <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span>
    <form action="" method="post">
      <input type="text" placeholder="Username"  name="username"/>
      <input type="password" placeholder="Password" name="password"/>
      <input type="submit" id="buttn" name="submit" value="login" />
    </form>
  </div>
  
  <div class="cta">Not registered?<a href="registration.php" style="color:#f30;"> Create an account</a></div>
</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

   



</body>

</html>
