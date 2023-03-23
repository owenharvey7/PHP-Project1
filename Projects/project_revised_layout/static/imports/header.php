<?php

//check for valid session
session_start();
if (!isset($_SESSION['loggedin'])) {
    //if not valid, redirect to login page
    header("Location: login.php");
}

function html_header($page_title)
{
    echo
    <<<EOT
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset = "utf-8" />
        <title>$page_title</title>
        <link rel="stylesheet" type="text/css" href="../static/css/rbv_home_layout.css" />
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow justify-content-between p-2">
    <div class="d-flex justify-content-start navbar-brand">
        <img src="../static/img/fish.png" width="100px" height="50px">
    </div>
    <div class=" float-right d-flex justify-content-end">
    <h3 class="text-center text-dark">Ron's <b id="bottle">Red</b> Book Apprasial &nbsp;</h3>
    <p><a class="btn btn-lg btn-block" href="../components/logout.php">Log Out</a></p>
        


    </div>

</nav>

EOT;
}
