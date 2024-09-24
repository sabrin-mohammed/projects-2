<?php
    session_start();
        include("connection.php");
        include("functions.php");
        $user_data = check($con);
        $id = $user_data['user_id'];

        $timeWorked = grab_time($con, $id);   
        $timeWorkedLast = grab_prev_time($con, $id);     
?>

<!DOCTYPE html>
<html>
<head>
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
		<p><?php echo $user_data['user_name']; ?>'s Hours</p>
	</div>
    <div class="container2">
		<div class="box-container">
			<div class="box" color="red">
                <p> Total Hours: <?php echo $timeWorked; ?></p>
		    </div>
            <div class="box">
                <p> Hours Worked Last Shift: <?php echo $timeWorkedLast; ?></p>
			</div>
        </div>
    </div>

    <a href="index.php">Return to Home Page</a>

    </div>
</body>
</html>