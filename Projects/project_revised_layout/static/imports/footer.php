<!-- End of Content -->
</div>

<div id="Menu">
    <a href="index.php" title="Home Page">Home</a><br />
    <?php
    session_start();
    // If the user is logged-in, show logout in the menu and change password links
    if (isset($_SESSION['user_id'])) {

        //still need to add logout page
        echo '<a href="logout.php" title="Logout">Logout</a><br />

    //still need to add change password page
    <a href="change_password.php" title="Change Your Password">Change Password</a><br />';
    } else { //  Not logged in.

        //still need to add registration page
        echo '<a href="put in project registration link" title="Register for the Site">Register</a><br />
    //still need to add login page
    <a href="login.php" title="Login">Login</a><br />
    //still need to add forgot password page
    <a href="forgot_password.php" title="Password Retrieval">Retrieve Password</a><br />';
    }
    ?>

</div>
</body>
</html>

