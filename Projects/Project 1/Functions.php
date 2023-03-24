<?php

function checkLogin($pdo)
{
    if(isset($_SESSION['userID'])){
        $displayForm = true;
        $id = $_SESSION['userID'];
        $query = "Select * from car_owners where userID = '$id'";

        $result = $pdo -> query($query);

            if(!$result -> rowCount()){
                header("Location: UserRegistration.php");
                echo "You will be redirected to the homepage in 5 seconds. 
                If you are not automatically redirected, click <a href='GetRedBookValue.php'>here</a>.";
                $displayForm = false;
                //Could return value with this method to set displayForm = false
            }
    }
    return $displayForm;
}
//Used to add new user to database
function addUser($pdo, $fname, $lname, $email, $password){
    //password_hash() creates a new password hash using a strong one-way hashing algorithm
//PASSWORD_DEFAULT - Use the bcrypt algorithm. Note that this constant is designed to change
//over time as new and stronger algorithms are added to PHP
//password_hash works with PHP 5.5 or higher
    $password = password_hash($password, PASSWORD_DEFAULT);
    //PHP Supports executing a prepared statement, which is used to execute the same
    // statement repeatedly with high efficiency.
    $query = "INSERT INTO car_owners (first_Name, last_Name, email, password) 
              VALUES ('$fname','$lname','$email','$password' )";
    $pdo -> query($query);
}

function destroy_session_and_data()
{
    $_SESSION = array();
    setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}

?>