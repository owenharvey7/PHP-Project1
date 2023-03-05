<?php
//check login
require_once 'login.php';
//check if user is logged in
if (isset($_SESSION['username'])) {
    //if user is logged in, show the page
    echo "Welcome to the page!";
} else {
    //if user is not logged in, redirect to login page
    header("Location: login.php");
}
?>



