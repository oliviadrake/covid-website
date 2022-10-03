<?php

    // when the user clicks logout theyre taken back to the login page and the session is destroyed
    session_destroy();
    header("location: loginpage.php");
?>
