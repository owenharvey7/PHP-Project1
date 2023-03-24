<?php

require_once"login.php";
try{
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
}catch(PDOException $e){
    die("Could not connect to the database." . "</body></hmtl>");
}
$trimmed = array_map('trim', $_POST);
$displayForm = true;

if(isset($_POST['LoginPressed'])){
    $emailEntered = $_POST['email'];
    $passwordEntered = $trimmed['password'];
    $error ='';

    $queryUser = "SELECT userID, first_name, last_name, email,password  FROM car_owners where email = '$emailEntered'";

    $result = $pdo -> query($queryUser);

    if($result->rowCount() == 1){
        $row = $result->fetch(PDO::FETCH_NUM);

        if (password_verify($passwordEntered, $row[4])) {
                session_start();
            // Register the values & redirect:
            $_SESSION['userID'] = $row[0];
            $_SESSION['fname'] = $row[1];
            $_SESSION['lname'] = $row[2];
            $_SESSION['email'] = $row[3];

            echo htmlspecialchars("Hi, your are now logged in as: $row[0], $row[1], $row[2], $row[3].");
            $displayForm = false;
            header("Refresh: 5; url=GetRedBookValue.php");
            echo "You will be redirected to the homepage in 5 seconds. If you are not automatically redirected, click <a href='GetRedBookValue.php'>here</a>.";

        }else
            $error = "Either the email address and password entered do not match those on file or you have no account yet.";

    }else
        $error = "Either the email address and password entered do not match those on file or you have no account yet.";

}
if($displayForm){
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login page</title>
</head>
<body>

    <form method="POST" >
        <div>Login Page</div>
        <br><br>
        Email: <input type = "email" name = "email" required>
        <br><br>
        Password: <input type = "password" name = "password" required> <?php echo ' <p style = "color: red;">' . $error . '</p>';?>
        <br><br>
        <input type="submit" name="LoginPressed" value="Login">
        <br><br>
        <a href = "UserRegistration.php"> Click to Signup </a>
    </form>
</body>
</html>
<?php }  ?>
