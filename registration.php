<?php

    // start the session and gather the username and password inputs
    session_start();
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if(!empty($password)){

        // check password is at least 8 characters
        if(strlen($password) < '8'){
            $passwordError = "Password Must be at Least 8 Characters Long";
        }

        // check password doesn't contain any special characters
        if(preg_match("#[.*?+[](){}^$|\]+#",$password)){
            if(isset($passwordError)){
                $passwordError = $passwordError + " and Must Only Contain Numbers and Letters";
            }
            else{
                $passwordError = "Password Must Only Contain Numbers and Letters";
            }
        }
    }

    // if there are no formatting mistakes with the password
    if(empty($passwordError)){
        // generate a random salt value
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $salt = '';
        for ($i = 0; $i < 10; $i++) {
            $salt .= $characters[rand(0, strlen($characters))];
        }

        // append the salt to the password
        $password = $password.$salt;

        // hash this
        $hashedpwd = md5($password);

        // establish connection to the database
        $conn = mysqli_connect("localhost","olivia","password","database");

        if(!$conn){
            die("Connection error: " . mysqli_connect_error());
        }
        else{
            // insert the username password and hash into the logins table
            $sql = "INSERT INTO logins(username, password, salt) VALUES(?,?,?)";
    		$stmt = mysqli_prepare($conn, $sql);
    		mysqli_stmt_bind_param($stmt, "sss", $username, $hashedpwd, $salt);

    		if(mysqli_stmt_execute($stmt)){

    		        // set up session username
    		        $_SESSION['username'] = $username;

    		        // close statement and connection
    		        mysqli_stmt_close();
    		        mysqli_close($conn);

    		        // take user to the home page
    		        header("location: homepage.php");
    		}

        }

    }else{
        // there are issues with the password requirements so stay on the page
        mysqli_close($conn);
        include('registrationpage.php');
    }
?>
