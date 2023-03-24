<?php
// This is the logout page for the site.

require_once ('login.php');


$name = '';
// If no session variable exists, redirect the user:
if (!isset($_SESSION['userID'])) {

    $url = "UserLogin.php";
    header("Location: $url");
    exit(); // Quit the script.

} else { // Log the user out
    $name = htmlspecialchars($_SESSION['fname']);
    $_SESSION = array(); // Destroy the variables.
    //setcookie (session_name(), '', time()-3600); // Destroy the cookie.
    destroy_session_and_data(); // Destroy the session itself and all its data.

}

//This function can be called when you need to destroy a session (usually when the user clicks a log out button)

// Print a customized message:
echo '<h3>You are now logged out, ' . $name . '</h3>';


?>