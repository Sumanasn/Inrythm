<?php
include "config.php";

if(isset($_POST['but_submit'])){

    $uname = mysqli_real_escape_string($con,$_POST['txt_uname']);
    $password = mysqli_real_escape_string($con,$_POST['txt_pwd']);

    if ($uname != "" && $password != "")
	{
 		$password = md5($password);
        $sql_query = "select count(*) as cntUser from users where username='".$uname."' and password='".$password."'";
        $result = mysqli_query($con,$sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if($count > 0){
            $_SESSION['uname'] = $uname;
            header('Location: home.php');
        }else{
            echo "Invalid username and password";
        }

    }

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
            <h2>Login</h2>
            <form action="" method="post">
                <div class="inputBox">
                    <input type="text" id="txt_uname" name="txt_uname" required="">
                    <label>username</label>
                </div>
                <div class="inputBox">
                    <input type="password" id="txt_uname" name="txt_pwd" required="">
                    <label>password</label>
                </div>
                <input type="submit" id="but_submit" name="but_submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="signin.php" style="color: aliceblue">Dont have an account? </a>
            </form>
        </div>
    </body>
</html>