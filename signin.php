<!doctype html>
<?php
include "config.php";

// initializing variables
$username = "";
$name    = "";



if(isset($_POST['register'])){

    $username = mysqli_real_escape_string($con,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);
	$name= mysqli_real_escape_string($con,$_POST['txt_name']);
    if ($name !="" && $username != "" && $password != ""){

 
  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $sql_query = "SELECT * FROM users WHERE username='$username'  LIMIT 1";
  $result = mysqli_query($con,$sql_query);
  $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
       echo  "Username already exists";
    }
 else {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO `users` ( `username`, `name`, `password`) VALUES('$username', '$name', '$password')";
  	mysqli_query($con, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
    
  }

  // Finally, register user if there are no errors in the form
 
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <title>InRythm</title>
        <link rel="stylesheet" href="formstyle.css">
    </head>
    
    <body>
        <div class="box">
            <h2>Sign Up</h2>
            <form action="" method="post">
                <div class="inputBox">
                    <input type="text" id="txt_uname" name="txt_name" required="">
                    <label>name</label>
                </div>
                <div class="inputBox">
                    <input type="text" id="txt_uname" name="txt_uname" required="">
                    <label>username</label>
                </div>
                
				<div class="inputBox">
                    <input type="password" id="txt_uname" name="txt_pwd" required="">
                    <label>password</label>
                </div>
				
                <input type="submit" id="but_submit" name="register" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" style="color: aliceblue">Already have an account? </a>
            </form>
        </div>
    </body>
</html>
