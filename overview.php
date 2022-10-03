<?php

    if (isset($_POST["do_delete"]))
    {
        // get variables to identify which record to delete
        $date = $_POST["date"];
        $time = $_POST["time"];

        // connect to database
    	$conn = mysqli_connect("localhost","olivia","password","coviddb");

        // check connection
    	if(!$conn){
    		die("Connection error: " . mysqli_connect_error());
    	}
    	else{
    		// delete where the date and time match
    		$sql = "DELETE FROM visits WHERE date='$date' AND time='$time'";
            mysqli_query($conn, $sql);
    	}

    	mysqli_close($conn);
        exit();
    }
?>
