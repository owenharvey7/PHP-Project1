<!DOCTYPE html>

<!-- Create a functioning form so people can use to add books to the database -->

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Ron's Red Book Appraisal</title>
    <style type="text/css">
        label {
            width: 5em;
            float: left;
        }
        .error {
            color: #ff0000;
            font-weight: bold;
            border: 0px none;
        }
    </style>
</head>
<body>

<?php
session_start();
// Connect to MySQL Server
include "Functions.php";
require_once 'login.php';
//Connect to MySQL Server: create a new object named $pdo
try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
$displayform = checkLogin($pdo);
echo $_SESSION['userID'];
$inputError = false;


$carYear_error = "";
$carYear_arr = array(
    "2010" => "2010",
    "2011" => "2011",
    "2012" => "2012",
    "2013" => "2013",
    "2014" => "2014",
    "2015" => "2015",
    "2016" => "2016",
    "2017" => "2017",
    "2018" => "2018",
    "2019" => "2019",
    "2020" => "2020"
);
$carMake_error = "";
$carMake_arr = array(
    "Acura" => "Acura",
    "Alfa Romeo" => "Alfa Romeo",
    "Aston Martin" => "Aston Martin",
    "Audi" => "Audi",
    "Bentley" => "Bentley",
    "BMW" => "BMW",
    "Buick" => "Buick",
    "Cadillac" => "Cadillac",
    "Chevrolet" => "Chevrolet",
    "Chrysler" => "Chrysler",
    "Dodge" => "Dodge",
    "Ferrari" => "Ferrari",
    "Fiat" => "Fiat",
    "Ford" => "Ford",
    "Genesis" => "Genesis",
    "GMC" => "GMC",
    "Honda" => "Honda",
    "Hyundai" => "Hyundai",
    "Infiniti" => "Infiniti",
    "Jaguar" => "Jaguar",
    "Jeep" => "Jeep",
    "Kia" => "Kia",
    "Lamborghini" => "Lamborghini",
    "Land Rover" => "Land Rover",
    "Lexus" => "Lexus",
    "Lincoln" => "Lincoln",
    "Lotus" => "Lotus",
    "Maserati" => "Maserati",
    "Mazda" => "Mazda",
    "McLaren" => "McLaren",
    "Mercedes-Benz" => "Mercedes-Benz",
    "Mini" => "Mini",
    "Mitsubishi" => "Mitsubishi",
    "Nissan" => "Nissan",
    "Porsche" => "Porsche",
    "Ram" => "Ram",
    "Rolls-Royce" => "Rolls-Royce",
    "Subaru" => "Subaru",
    "Tesla" => "Tesla",
    "Toyota" => "Toyota",
    "Volkswagen" => "Volkswagen",
    "Volvo" => "Volvo"
);
$carModel_error = "";
$carModel_arr = array(
    "A3" => "A3",
    "A4" => "A4",
    "A5" => "A5",
    "A6" => "A6",
    "A7" => "A7",
    "A8" => "A8",
    "Q3" => "Q3",
    "Q5" => "Q5",
    "Q7" => "Q7",
    "Q8" => "Q8",
    "R8" => "R8",
    "RS3" => "RS3",
    "RS5" => "RS5",
    "RS7" => "RS7",
    "S3" => "S3",
    "S4" => "S4",
    "S5" => "S5",
    "S6" => "S6",
    "S7" => "S7",
    "S8" => "S8",
    "SQ5" => "SQ5",
    "TT" => "TT",
    "TTS" => "TTS"
);

if (isset($_POST['submit'])) {
    echo "<h3>Thank you for your submission.</h3>";
    if (isset($_POST['carYear'])) {
        $carYear_arr = $_POST['carYear'];
    } else {
        $carYear_error = "Please select a year";
    }
    if (isset($_POST['carMake'])) {
        $carMake_arr = $_POST['carMake'];
    } else {
        $carMake_error = "Please select a make";
    }
    if (isset($_POST['carModel'])) {
        $carModel_arr = $_POST['carModel'];
    } else {
        $carModel_error = "Please select a model";
    }
    if (!empty($carYear_arr) && !empty($carMake_arr) && !empty($carModel_arr)) {
        $displayform = false;
        echo "<h3>Thank you for your submission.</h3>";
    }
}

if ($inputError == false) {
    $carYear = implode(", ", $carYear_arr);
    $carMake = implode(", ", $carMake_arr);
    $carModel = implode(", ", $carModel_arr);

    echo "<p>Car Year: " . $carYear . "</p>";
    echo "<p>Car Make: " . $carMake . "</p>";
    echo "<p>Car Model: " . $carModel . "</p>";
    $sql = "SELECT * FROM cars WHERE year = '$carYear' AND make = '$carMake' AND model = '$carModel'";
    try {
        $result = $pdo->query($sql);
    } catch (PDOException $e) {
        echo $e->getMessage();
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }


    if ($result->rowCount() > 0) {
        while ($row = $result->fetch()) {
            echo "<p>Car Year: " . $row['carYear'] . "</p>";
            echo "<p>Car Make: " . $row['carMake'] . "</p>";
            echo "<p>Car Model: " . $row['carModel'] . "</p>";
            echo "<p>Car Price: " . $row['carPrice'] . "</p>";
        }
    } else {
        echo "<p>No records matching your query were found.</p>";
    }
}


if ($displayform){
?>
<form>

    <p>Use the following form to find the value of your car:</p>
    <form method="post" action="Get%20Red%20Book%20Value.php">
        <input type="text" id="carYear_error" class="error" size="40" value="<?php echo $carYear_error; ?>">
        <fieldset>
            <legend>Enter the Year of Your Car:</legend>
            <select>
                <?php
                foreach ($carYear_arr as $key => $value) {
                    $checked = (!empty($carYear_arr) && in_array($key, $carYear_arr)) ? "checked" : "";
                    echo "<option type='checkbox' name='carYear[]' value='$key' checked=$checked >$value</option>";
                }
                ?>
            </select>
        </fieldset>


        <input type="text" id="carMake_error" class="error" size="40" value="<?php echo $carMake_error; ?>">

        <fieldset>
            <legend>Select the Make of Your Car:</legend>
            <select>
                <?php
                foreach ($carMake_arr as $key => $value) {
                    $checked = (!empty($carMake_arr) && in_array($key, $carMake_arr)) ? "checked" : "";
                    echo "<option type='checkbox' name='carMake[]' value='$key' checked=$checked >$value</option>";
                }
                ?>
            </select>
        </fieldset>

        <input type="text" id="carModel_error" class="error" size="40" value="<?php echo $carModel_error; ?>">

        <fieldset>
            <legend>Select the Model of Your Car:</legend>
            <select>
                <?php
                foreach ($carModel_arr as $key => $value) {
                    $checked = (!empty($carModel_arr) && in_array($key, $carModel_arr)) ? "checked" : "";
                    echo "<option type='checkbox' name='carModel[]' value='$key' checked=$checked >$value</option>";
                }
                ?>
            </select>

        </fieldset>

        </p>
        <p>
            <input type="submit" name="addCar" value="Find Car Value"/>&nbsp;&nbsp;
            <input type="reset" name="reset" value="Reset"/>
        </p>
        <a href = "logout.php">Logout </a>
    </form>

    <?php
    }
    ?>
