<?php
session_start();
require_once"login.php";
include ("Functions.php");
try{
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
}catch(PDOException $e){
    die("Could not connect to the database." . "</body></hmtl>");
}
$ifRegistered = false;

if(isset($_POST['RegisterPressed'])){
    $email = trim($_POST['email']);
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirmPassword']);

    $emailError = '';
    $fnameError ='';
    $lnameError ='';
    $passwordError ='';
    $confirmPasswordError ='';



    if(empty($email))
        $emailError = "Please enter your email.";
    if(empty($fname))
        $fnameError = 'Please enter your first name.';
    if(empty($lname))
        $lnameError = 'Please enter your last name.';
    if(empty($password))
        $passwordError = 'Please enter your password.';
    if(empty($confirmPassword))
        $confirmPasswordError = 'Please re-enter your password.';

if(empty($emailError) && empty($fnameError) && empty($lnameError) && empty($passwordError) && empty($confirmPasswordError)){
    if ($password != $confirmPassword) {
        $passwordError = "Password entries must match.";
    } else if (preg_match("/.{6,}/", $password) == 0) {
        $passwordError = "Passwords must have a length of 6 or more characters.";
    } else {
        //Function Found the the file: Functions.php
        addUser($pdo, $fname, $lname, $email, $password);
        $ifRegistered = true;
    }
}
}//end of isset

if(!$ifRegistered){
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
</head>
<body>

<form method="POST">
    <h2>Register Page</h2>
    <br><br>
    Email:<input type = "email" name = "email" placeholder="email" required>
    <?php echo '<p style="color: red;">' . $emailError . '</p>';?>

    <br>

    First Name: <input type = "text" name = "fname" placeholder="First Name" required>
    <?php echo '<p style="color: red;">' . $fnameError . '</p>';?>
    <br>
    Last Name:
    <input type = "text" name = "lname" placeholder="Last Name" required>
    <?php echo '<p style="color: red;">' . $lnameError . '</p>';?>
    <br>
    Password:
    <input type = "password" name = "password" placeholder="Password" required>
    <?php echo '<p style="color: red;">' . $passwordError . '</p>';?>
    <br>
    Confirm Password:
    <input type = "password" name = "confirmPassword" placeholder="Re-enter Password" required>
    <?php echo '<p style="color: red;">' . $confirmPasswordError . '</p>';?>
    <br>

    <input type="submit" name="RegisterPressed" value="Register">
    <br><br>
    Already have an existing account? <a href = "UserLogin.php"> Click to Login. </a>
</form>
</body>
</html>
<?php }else{
    echo <<< form
<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
</head>
<body>
<p>Hello $fname. We are thankful that you selected to register for our website. Now that
you have an account feel free to<a href = "UserLogin.php"> try our site. </a></p>
</body>
</html>
form;

}?>