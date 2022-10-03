<?php

    // start a session and gather username and password from login form
    session_start();
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // connect to the database
    $conn = mysqli_connect("localhost","olivia","password","coviddb");

    // check connection is established
    if(!$conn){
        die("Connection error: " . mysqli_connect_error());
    }
    else{
        // select all the data from the inputted password
        $sql = "SELECT * FROM logins WHERE username='$username'";
        if(!($result = mysqli_query($conn, $sql))){
            $errormessage = "Couldn't complete query";
        }else{

            // check if any exist
            if (mysqli_num_rows($result) > 0) {

                // get the password and salt from the corresponding username
                while($row = mysqli_fetch_array($result)) {
                    $dbpassword = $row['password'];
                    $dbsalt = $row['salt'];
                }

                // calculate the hash of the inputted password using the salt from the database
                $unhashedpwd = $password.$dbsalt;
                $hashedpwd = md5($unhashedpwd);

                // if passwords match, set up the session username and take user to the homepage
                if($hashedpwd == $dbpassword){
                    $_SESSION['username'] = $username;
                    mysqli_close($conn);
                    header("location: homepage.php");
                }
                else{
                    $errormessage = "Incorrect Password";
                }
            }
            else{
                $errormessage = "No account linked to that username";
            }
        }
    }

    mysqli_close($conn);

    // if passwords dont match or there is no one saved with that username, display an error message
    if(isset($errormessage)){
        include("loginpage.php");
    }

?>
