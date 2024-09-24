<?php
    session_start();
        include("connection.php");
        include("functions.php");
        $user_data = check($con);
        $user = $user_data['user_name'];
        $id = $user_data['user_id'];


    // checks if you are clocked in. if you aren't keeps you at 
    // index/home page. 0 = you are not clocked
    if(check_clock_in($con, $user, $id) == 0) {
        header("Location: index.php");
        die();
    }

    //checks if you are clocke in. if you are sets up clock out
    //1 = you are clocked in
    if(check_clock_in($con, $user, $id) == 1) {
        // user is already clocked in, display alert message
        $query = "update clocktime set TimeOut=NOW() order by TimeOut limit 1";
        mysqli_query($con, $query);

        //calls functions that calculate time 
        $time = time_count($con, $user, $id);
        $pay = transfer($con, $user, $id);

        //sets time to eastern time
        date_default_timezone_set('America/Indiana/Indianapolis');
        $date = date('m/d/Y h:i:s a', time());

        //change the check to be 1 to show that you have clocked in
        $query = "update clocktime set clock_check = 0 where user_name = '$user' and user_id = '$id'";
        $run = mysqli_query($con, $query);
    }

?>

<!DOCTYPE html>
<html>
<head>
    </head>
    <body>
        <p> You have successfully clocked-out at <?php echo $date; ?></p>
            <a href="index.php">Return To Home Page</a>
        </form>
    </div>
</body>
</html>