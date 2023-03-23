<?php

require_once '../components/db_login.php';

$errors = array();

if (isset($_POST['submit'])) {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Check for empty fields
    if (empty($firstname)) {
        $errors[] = 'Firstname is required';
    }
    if (empty($lastname)) {
        $errors[] = 'Lastname is required';
    }
    if (empty($username)) {
        $errors[] = 'Username is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    }
    if (empty($password)) {
        $errors[] = 'Password is required';
    }

    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<p style="color: red;">' . $error . '</p>';
        }
    } else {
        try {
            $pdo = new PDO($dsn, $dbUser, $dbPassword);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }


        //hash password
        $password = password_hash($password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO users (firstname, lastname, username, email, password) VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";
        $result = $pdo->query($sql);
        if($result->execute()){
            echo '<p style="color: green;">User registration successful!</p>';
        }else{
            echo '<p style="color: red;">User registration failed!</p>';
        }
    }

}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header">
            <h3>Register</h3>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="form-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
