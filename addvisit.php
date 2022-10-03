<?php

	// join the session
    session_start();

    // get all data of the new visit
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $duration = htmlspecialchars($_POST['duration']);
    $xcoord = htmlspecialchars($_POST['xcoord']);
    $ycoord = htmlspecialchars($_POST['ycoord']);


    // get session username
    $username = $_SESSION['username'];

    // connect to database
    $conn = mysqli_connect("localhost","olivia","password","coviddb");

    // check connection
    if(!$conn){
        die("Connection error: " . mysqli_connect_error());
    }
    else{
        // put all the data into the visits table in the database
        $sql = "INSERT INTO visits(username, date, time, duration, x, y) VALUES(?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssiii', $username, $date, $time, $duration, $xcoord, $ycoord);

        if(mysqli_stmt_execute($stmt)){

        mysqli_stmt_close();
        mysqli_close($conn);

        // take user back to the add visit page
        header("location: addvisitpage.php");
}else{

echo "NOT EXECUTED";
}
    }

?>
