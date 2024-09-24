<?php
session_start();

        include("connection.php");
        include("functions.php");

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            //something was posted
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];

            if(!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
				//Checking for Admin account
				if($user_name == 'Admin' && $password == 'Admin1234') {
					header("Location: admin.php");
					die;
				}
				//read from database
                $query = "select * from users where user_name = '$user_name' limit 1";
				
                $result = mysqli_query($con, $query);

                if($result) {
                	if($result && mysqli_num_rows($result) > 0) {

                		$user_data = mysqli_fetch_assoc($result);
                		
                		if($user_data['password'] === $password) {
                			$_SESSION['user_id'] = $user_data['user_id'];
                			header("Location: index.php");
                			die;
                		}
                	} 		
                }
                echo "Wrong username or password!";
            } else {
                echo "Wrong username or password!";
            }

        }

?>

<!DOCTYPE html>
<html>
<head>
		<title>Employee Login</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div class="login">
			<h1>Redhawk Employee Login</h1>
			<img src="MiamiLogo.png" alt="Miami" class= "center">
			<form method="post">
			<input id="text" type="text" name="user_name" placeholder="Username"><br><br>
			<input id="text" type="password" name="password" placeholder="Password"><br><br>
			<input id="button" type="submit" value="Login"><br><br>
				<a href="signup.php">Click to Signup</a>
		</form>
	</div>
</body>
</html>