<?php
    session_start();
        include("connection.php");
        include("functions.php");
        $user_data = check($con);
        $user = $user_data['user_name'];
        $id = $user_data['user_id'];

        $count = clockin($con, $user, $id);
        //$time = NOW();

        //sets the time zone to eastern time and prints out the date and time
        date_default_timezone_set('America/Indiana/Indianapolis');
        $date = date('m/d/Y h:i:s a', time());

        if(check_clock_in($con, $user, $id) == 1) {
            header("Location: index.php");
            die();
        } else {
        //change the check to be 1 to show that you have clocked in
        $query = "update clocktime set clock_check = 1 where user_name = '$user' and user_id = '$id'";
        $run = mysqli_query($con, $query);
        }
        
?>

<!DOCTYPE html>
<html>
<head>
    </head>
    <body>
        <p> You have successfully clocked-in at <?php echo $date; ?></p>
            <a href="index.php">Return to Home Page</a>
        </form>
    </div>
</body>
</html>
