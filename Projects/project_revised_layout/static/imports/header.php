<?php
// This page begins the HTML header for the site.

// Check for a $page_title value:
if (!isset($page_title)) {
    $page_title = 'User Registration';
}
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset = "utf-8" />
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" type="text/css" href="../css/rbv_home_layout.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<div id="Header">Ron's Red Book</div>
<div id="Content">
    <!-- End of Header -->

