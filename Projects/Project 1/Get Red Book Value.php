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
// Connect to MySQL Server
require_once 'login.php';

$displayform = true;
$inputError = false;

//Connect to MySQL Server: create a new object named $pdo
try {
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

//Array list of years, car makes, and car models
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
    "2020" => "2020",
    "2021" => "2021",
    "2022" => "2022",
    "2023" => "2023",
);
$carMake_error = "";
$carMake_arr = array(
    "Acura" => "Acura",
    "Audi" => "Audi",
    "BMW" => "BMW",
    "Buick" => "Buick",
    "Cadillac" => "Cadillac",
    "Chevrolet" => "Chevrolet",
    "Chrysler" => "Chrysler",
    "Dodge" => "Dodge",
    "Ferrari" => "Ferrari",
    "Fiat" => "Fiat",
    "Ford" => "Ford",
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
    "Maserati" => "Maserati",
    "Mazda" => "Mazda",
    "Mercedes-Benz" => "Mercedes-Benz",
    "Mini" => "Mini",
    "Mitsubishi" => "Mitsubishi",
    "Nissan" => "Nissan",
    "Porsche" => "Porsche",
    "Ram" => "Ram",
    "Subaru" => "Subaru",
    "Tesla" => "Tesla",
    "Toyota" => "Toyota",
    "Volkswagen" => "Volkswagen",
    "Volvo" => "Volvo",
);
$carModel_error = "";
$carModel_arr = array(
    "Focus" => "Focus",
    "Fusion" => "Fusion",
    "Accord" => "Accord",
    "Civic" => "Civic",
    "Prius" => "Prius",
    "Camry" => "Camry",
    "Corolla" => "Corolla",
    "Mustang" => "Mustang",
    "Explorer" => "Explorer",
    "F-150" => "F-150",
    "Tundra" => "Tundra",
    "Highlander" => "Highlander",
    "Rav4" => "Rav4",
    "Cruze" => "Cruze",
    "Malibu" => "Malibu",
    "Impala" => "Impala",
    "Silverado" => "Silverado",
    "Equinox" => "Equinox",
    "Tahoe" => "Tahoe",
    "Charger" => "Charger",
    "Challenger" => "Challenger",
    "Durango" => "Durango",
    "Grand Caravan" => "Grand Caravan",
    "Pacifica" => "Pacifica",
    "Wrangler" => "Wrangler",
    "Cherokee" => "Cherokee",
    "Grand Cherokee" => "Grand Cherokee",
    "Model S" => "Model S",
    "Model X" => "Model X",
    "Model 3" => "Model 3",
    "Model Y" => "Model Y",

);



if (isset($_POST['submit-button'])) {

    //create variables that store the value that is chosen by the user and deletes all other characters in the arrays
    $carYear = $_POST['carYear'];;
    $carMake = $_POST['carMake'];
    $carModel = $_POST['carModel'];



    echo "<br>";


    // Check if the car is in the database
    $sql = "Select * from cars where make = '$carMake' AND model = '$carModel' and year = '$carYear';";
    //search the cars database using $sql

    echo $sql;

    $result = $pdo->query($sql);

    $table =  $table = "<table width='100%' border='1'>";

    $table .= "<tr><th>Make</th><th>Model</th><th>Year</th><th>Value</th></tr>";

    //if statement for if the car is in the database
    if($result->rowCount() > 0) {
        echo "<br><br>There is a ", $carYear , " ", $carMake , " ", $carModel , " in our database.";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $table .= "<tr><td>" . $row['make'] . "</td><td>" . $row['model'] . "</td><td>" . $row['year'] . "</td><td>" . $row['base_price'] . "</td></tr>";
        }
        $table .= "</table>";
        echo $table;
        $displayform = false;
    } else {
        echo "<br><br>There is no ", $carYear , " ", $carMake , " ", $carModel , " in our database.";
        $displayform = false;
    }

//

    } else {"Please enter a valid year, make, and model.";

}

if ($displayform){
?>

<h2><center>Use the following form to find the value of your car:</center></h2>
<form method="post" action="Get%20Red%20Book%20Value.php">
    <fieldset>
        <legend>Enter the Year of Your Car:</legend>
        <select name = 'carYear'>
            <?php
            foreach ($carYear_arr as $key => $value) {
                $checked = (!empty($carYear_arr) && in_array($key, $carYear_arr)) ? "checked" : "";
                echo "<option type='checkbox' name='carYear' value='$key' checked=$checked >$value</option>";
            }
            ?>
        </select>
    </fieldset>


    <fieldset>
        <legend>Select the Make of Your Car:</legend>
        <select name = carMake>
            <?php
            foreach ($carMake_arr as $key => $value) {
                $checked = (!empty($carMake_arr) && in_array($key, $carMake_arr)) ? "checked" : "";
                echo "<option type='checkbox' name='carMake[]' value='$key' checked=$checked >$value</option>";
            }
            ?>
        </select>
    </fieldset>


    <fieldset>
        <legend>Select the Model of Your Car:</legend>
        <select name = 'carModel'>
            <?php
            foreach ($carModel_arr as $key => $value) {
                $checked = (!empty($carModel_arr) && in_array($key, $carModel_arr)) ? "checked" : "";
                echo "<option type='checkbox' name='carModel[]' value='$key' checked=$checked >$value</option>";
            }
            ?>
        </select>

    </fieldset>

    <br><br>
    <input type="submit" name="submit-button"/>
    <input type="reset" name="reset" value="Reset"/>

</form>



</body>
</html>

<?php
}
//search a new car
echo "<br><p><a href=\"Get%20Red%20Book%20Value.php\">Look for another car value</a></p>\n";
?>