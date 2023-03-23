<?php

//log out the user
session_start();
session_destroy();
header("location: ../pages/login.php");