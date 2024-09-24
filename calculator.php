<?php
// Step 1: Connect to the database
// $host = "localhost"; // Replace with your database host
// $username = "root"; // Replace with your database username
// $password = ""; // Replace with your database password
// $dbname = "login_sample_db"; // Replace with your database name
// $connection = mysqli_connect($host, $username, $password, $dbname);
session_start();
include("connection.php");
include("functions.php");

$user_data = check($con);
$user = $user_data['user_name'];
$id = $user_data['id'];


// Step 2: Retrieve the hours worked from the database
 // Replace with the ID of the employee
$query = "select timeWorked FROM users WHERE id = '$id' and user_name = '$user'";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$hours_worked = $row['timeWorked'];

// Step 3: Multiply the hours worked by a set pay value
$pay_rate = 15.0; // Replace with the set pay value
$total_pay = $hours_worked * $pay_rate;

// Step 4: Display the total pay to the user
// echo "Hours worked(from SQL DB): " .number_format($hours_worked, 2) . "<br>";
// echo "PayRate(hardcoded): " .number_format($pay_rate, 2) . "<br>";
// echo "Total pay: $" . number_format($total_pay, 2);
?>

<!DOCTYPE html>
<html>
	
	<head>
		<!-- Include Bootstrap CSS file from a CDN -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="calcstyle.css">
		
		<!-- Include Bootstrap JavaScript files from a CDN -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<title>Paycheck Calculator</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
</head>
<body>
	<div class="container text-center">
		<h1>Estimated Paycheck Calculator</h1>
	</div>
	<div class="container w-50 mx-auto">
		<form>
			<div class="row">
				<div class="col text-center">
					<label for="hours-worked">Hours Worked:</label>
					<input type="number" id="hours-worked" class="form-control">
				</div>
			</div>
			<div class="row">
				<div class="col text-center">
					<label for="hourly-rate">Hourly Rate:</label>
					<input type="number" id="hourly-rate" class="form-control">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col text-center">
					<button type="button" id="calculate-btn" class="btn btn-primary">Calculate</button>
				</div>
			</div>
		</form>
	</div>
	
	<p id="result"></p>
	
	<div style="text-align: center;">

	<p>Note: Overtime pay will be paid at 1.5 times the regular rate of pay for hours worked over 40 in a workweek.</p>
	</div>
		<script src="calc.js"></script>
		
		
	<br>
	
	<div class="container text-center">
		<h1>Actual Paycheck Calculator</h1>
		<p> <?php echo "Hours worked(from SQL DB): " .number_format($hours_worked, 2); ?> <br> <?php echo "PayRate(hardcoded): " .number_format($pay_rate, 2); ?>
		<br> <?php echo "Total pay: $" . number_format($total_pay, 2); ?> </p>


	</div>
	
 <a href="index.php">Return To Home Page</a>
</body>
</html>