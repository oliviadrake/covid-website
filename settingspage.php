<?php

    // gather data from the form
    $distance = htmlspecialchars($_POST['distance']);
    $window = htmlspecialchars($_POST['window']);

    // set distance cookie
    $cookie_name = "distance";
    $cookie_value = $distance;
    $path = "/";

    setcookie($cookie_name, $cookie_value, $path);

    // set time window cookie
    $cookie_name = "window";
    $cookie_value = $window;
    $path = "/";

    setcookie($cookie_name, $cookie_value, $path);

    header("location: settingspage.php");

?>
