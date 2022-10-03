<?php
	// join the session
    session_start();

    // get session username and all data from the form
    $date = htmlspecialchars($_POST['date']);
    $time = htmlspecialchars($_POST['time']);
    $username = $_SESSION['username'];

    // connect to the database
    $conn = mysqli_connect("localhost","olivia","password","database");

    // check the connection
    if(!$conn){
        die("Connection error: " . mysqli_connect_error());
    }
    else{
        // add the reported infection to a table of infections
        $sql = "INSERT INTO infections(username, date, time) VALUES(?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $date, $time);

        mysqli_stmt_execute($stmt);

        mysqli_stmt_close();

        // gather a list of all the user's visits
        $sql = "SELECT * FROM visits WHERE username='$username'";
        if(!$visits = mysqli_query($conn, $sql)){echo"fuck";}
    }

    // initialise CURL request to API
    $url = "http://ml-lab-7b3a1aae-e63e-46ec-90c4-4e430b434198.ukwest.cloudapp.azure.com:60999/report";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);

    // check the user has any visits
    if (mysqli_num_rows($visits) > 0) {
        while($row = mysqli_fetch_array($visits)) {

            // for each visit, gather all the variables
            $date = $row['date'];
            $time = $row['time'];
            $duration = $row['duration'];
            $x = $row['x'];
            $y = $row['y'];

            // check all the data is in the correct format
            if (!is_numeric($x) or !is_numeric($y)) {
                http_response_code(400);
                echo("Wrong format for coordinates. Must be integer.");
            }
            if (!DateTime::createFromFormat('Y-m-d', $date)) {
                http_response_code(400);
                echo("Wrong date format. Must be yyyy-mm-dd");
            }
            if (!DateTime::createFromFormat('H:i:s', $time)) {
                http_response_code(400);
                echo("Wrong time format. Must be hh:mm:ss");
            }
            if (!is_numeric($duration)){
                http_response_code(400);
                echo("Wrong format for duration. Must be integer.");
            }

            // turn date and time variables into strings
            $date = (string)$date;
            $time = (string)$time;

            // set up posting variables
            curl_setopt($curl, CURLOPT_POSTFIELDS,['x'=>$x, 'y'=>$y, 'date'=>$date,'time'=>$time,'duration'=>$duration]);
            // execute request
            curl_exec($curl);
        }
    }

    // close connections and take user back to report page
    curl_close($ch);
    mysqli_close($conn);
    header("location: reportpage.php");
?>
