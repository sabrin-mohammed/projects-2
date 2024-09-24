<?php  
session_start();
	include("connection.php");
	include("functions.php");
	$user_data = check_login($con);
	$data = check($con);
	$user = $data['user_name'];
	$id = $data['user_id'];
	
	//sends message depending on clock_check number
    if(check_clock_in($con, $user, $id) == 1) {
    	echo "You are clocked in";
    } else {
    	echo "You are not clocked in";
    }
        
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home Page</title>
		<link href="style2.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="homestyle.css" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">

		

	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div class="container">
				<h1>RedHawkInc</h1>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<p>Welcome back, <?php echo $user_data['user_name']; ?>
		</div>
		<div class="container2">
		<div class="box-container">
			<div class="box">
				<img src="clock.png" alt="">
				<h3> </h3>
				<a href="ClockIn.php" class="btn" name="Clock-In">Clock-In</a>
			</div>
			<div class="box">
				<img src="clock.png" alt="">
				<h3> </h3>
				<a href="ClockOut.php" class="btn" name="Clock-Out">Clock-Out</a>
			</div>
			<div class="box">
				<img src="calculator.png" alt="">
				<h3> </h3>
				<a href="calculator.php" class="btn">Calculate Weekly Pay</a>
			</div>
			<div class="box">
				<img src="briefcase.png" alt="">
				<h3> </h3>
				<a href="hoursWorked.php" class="btn">Hours Worked</a>
			</div>
		</div>	
	</body>
</html>