<?php

function check_login($con) {

	if(isset($_SESSION['user_id'])) {

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;
}

//used to set up the user_id for each user
function random_num($length) {
	$text = "";
	if($length < 5) {
		$length = 5;
	}

	$len = rand(4,$length);
	for ($i=0; $i < $len; $i++) { 
		// code...
		$text .= rand(0,9);
	}

	return $text;
}

//inserts user into table and saves their username, id, and time they clocked in if they don't have a record in the table, otherwise updates the time they clocked if they already have a record in the table. 
function clockin($con, $user, $id) {
	$query = "Select user_name from clocktime where user_name = '$user' and user_id = '$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);

	//echo $result;

	//checks whether the user_name and user_id are already in the table
	if(!isset($row['user_name']) && !isset($row['user_id'])) {
		//creates new record if record isn't already in the table 
		$query = "insert into clocktime (user_id, user_name, TimeIn,TimeOut,clock_check) Values ('$id','$user', NOW(),0, 0)";
		mysqli_query($con, $query);
	} else {
		//updates the current record where user_name and user_id are the same if the record already exists in the table
		$query = "update clocktime set TimeIn = NOW() where user_name = '$user' and user_id = '$id'";
		mysqli_query($con, $query);
	}
}
// calculates the hours worked once you clock out and inserts into
// timeWorked column
function time_count($con, $user, $id) {
	// grabs the time you clocked in and time you clocked out
	$TimeInOut = "Select TimeIn, TimeOut from clocktime where user_name = '$user' and user_id = '$id' order by TimeIn";
	$result3 = mysqli_query($con, $TimeInOut);
	$row = mysqli_fetch_assoc($result3);

	// grabs the timeWorked in total to add more hours 
	$initial = "Select timeWorked from users where user_name = '$user' and user_id = '$id'";
	$res = mysqli_query($con, $initial);
	$row2 = mysqli_fetch_assoc($res);

	//checks whether clock-out time is greater that clock-in time
	if($row['TimeOut'] > $row['TimeIn']) {
		//substracts the clock-out time with clock-in time 
		$diff = ((int)$row['TimeOut'] - (int)$row['TimeIn']);
		// adds the differenc and the timeworked number that was grabbed together
		$total = $row2['timeWorked'] + $diff;
		//stores the new total number into timeWorked
		$query = "update users set timeWorked = '$total' where user_name = '$user'";
		$result = mysqli_query($con, $query); 

	} else {
		//does the same as above just subtracts the clock in time with the clock-out time if clock-in is greater
		$diff = ((int)$row['TimeIn'] - (int)$row['TimeOut']);
		$total = $row2['timeWorked'] + $diff;
		$query = "update users set timeWorked = '$total' where user_name = '$user' and user_id = '$id'";
		$result = mysqli_query($con, $query); 
	}
}

//checks how many times user has clocked-out (limit 5) to show a five day work week. then transfers the amount of hours worked that week into the pay_calc record to help with pay calc feature
function transfer($con, $user, $id) {
	// uses sql query to grab clicks
	$query = "Select Clicks from users where user_name = '$user' and user_id = '$id'";
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($result);

	// increments click everytime function is called
	$row['Clicks']++;
	$click = $row['Clicks'];
	// then updates with the new click amount
	$query = "update users set Clicks= '$click' where user_name = '$user' and user_id = '$id'";
	$result = mysqli_query($con, $query);

	// checks if clicks is equal to 5 and if it is transfer the time from timeWorked to pay_calc_num to show hours worked previous week
	if($click == 5) {
		$row['Clicks'] = 0;
		$click = 0;
		$query = "Select timeWorked from users where user_name = '$user' and user_id = '$id'";
		$res = mysqli_query($con, $query);
		$row2 = mysqli_fetch_assoc($res);
		$total = $row2['timeWorked'];

		$query2 = "update users set Pay_Calc_Num ='$total', timeWorked = 0, Clicks = 0 where user_name = '$user' and user_id = '$id'";
		$res2 = mysqli_query($con, $query2);
	}
		
}

function check($con) {
	if(isset($_SESSION['user_id'])) {

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0) {

				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
		}
	}
	die();
}

//grabs the number from the record clock_check and returns that number
function check_clock_in($con, $user, $id) {
	$query = "Select clock_check from clocktime where user_name = '$user' and user_id = '$id'";
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
    return $row['clock_check'];
}

function grab_time($con, $id) {
	$query = "Select timeWorked from users where user_id = '$id'";
	$res = mysqli_query($con, $query);
	$row = mysqli_fetch_assoc($res);
	return $row['timeWorked'];
}

function grab_prev_time($con, $id) {
	// grabs the time you clocked in and time you clocked out
	$TimeInOut = "Select TimeIn, TimeOut from clocktime where user_id = '$id' order by TimeIn";
	$result3 = mysqli_query($con, $TimeInOut);
	$row = mysqli_fetch_assoc($result3);

	//checks whether clock-out time is greater that clock-in time
	if($row['TimeOut'] > $row['TimeIn']) {
		//substracts the clock-out time with clock-in time 
		return ((int)$row['TimeOut'] - (int)$row['TimeIn']);
	} else {
		//does the same as above just subtracts the clock in time with the clock-out time if clock-in is greater
		return ((int)$row['TimeIn'] - (int)$row['TimeOut']);
	}
}