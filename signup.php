<?php
session_start();

        include("connection.php");
        include("functions.php");

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            //something was posted
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];

            if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
                //save to database
                $user_id = random_num(20);
                $query = "insert into users (user_id,user_name,password,Clicks,TimeWorked,Pay_Calc_Num)
                    values ('$user_id','$user_name','$password',0,0,0)";

                mysqli_query($con, $query);
                header("Location: login.php");
                die;

            } else {
                echo "Please enter some valid information!";
            }

        }

?>

<!DOCTYPE html>
<html>
<head>
	<title>Employee Sign-up</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="login">
            <h1>Redhawk Employee Sign-up</h1>
            <img src="MiamiLogo.png" alt="Miami" class= "center">
            <form method="post">
            <input id="text" type="text" name="user_name" placeholder="Username"><br><br>
            <input id="text" type="password" name="password" placeholder="Password"><br><br>
            <input id="button" type="submit" value="Sign-up"><br><br>
                <a href="login.php">Click to Login</a>
		</form>
	</div>
</body>
</html>