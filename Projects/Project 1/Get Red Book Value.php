<!DOCTYPE html>

<!-- Create a functioning form so people can use to add books to the database -->

<html xmlns = "http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>Ron's Red Book Appraisal</title>
    <style type = "text/css">
        label  { width: 5em; float: left; }
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
}
catch (PDOException $e){
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}





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

    if(isset($_POST['submit'])){
        if(isset($_POST['carYear'])){
            $carYear_arr = $_POST['carYear'];
        }
        else{
            $carYear_error = "Please select a year";
        }
        if(isset($_POST['carMake'])){
            $carMake_arr = $_POST['carMake'];
        }
        else{
            $carMake_error = "Please select a make";
        }
        if(isset($_POST['carModel'])){
            $carModel_arr = $_POST['carModel'];
        }
        else{
            $carModel_error = "Please select a model";
        }
        if(!empty($carYear_arr) && !empty($carMake_arr) && !empty($carModel_arr)){
            $displayform = false;
        }
    }

    if($inputError == false){
        $carYear = implode(", ", $carYear_arr);
        $carMake = implode(", ", $carMake_arr);
        $carModel = implode(", ", $carModel_arr);

        $sql = "SELECT * FROM car WHERE carYear = '$carYear' AND carMake = '$carMake' AND carModel = '$carModel'";
    $result = $pdo->query($sql);

    if($result->rowCount() > 0){
        while($row = $result->fetch()){
            echo "<p>Car Year: " . $row['carYear'] . "</p>";
            echo "<p>Car Make: " . $row['carMake'] . "</p>";
            echo "<p>Car Model: " . $row['carModel'] . "</p>";
            echo "<p>Car Price: " . $row['carPrice'] . "</p>";
        }
    } else {
        echo "<p>No records matching your query were found.</p>";
    }
    }




if($displayform == true){
    ?>
<form>

    <p>Use the following form to find the value of your car:</p>
    <form method = "post" action = "Get%20Red%20Book%20Value.php">
        <fieldset>
            <input type="text" id="carYear_error" class ="error" size = "40" value="<?php echo $carYear_error; ?>">
            <legend>Enter the Year of Your Car: </legend>
            <br />
            <input type="checkbox" name="carYear[]" value="2010" <?php echo (!empty($carYear_arr) && in_array("2010", $carYear_arr))  ? "checked" : "";?>/>2010 <br />
            <input type="checkbox" name="carYear[]" value="2011" <?php echo (!empty($carYear_arr) && in_array("2011", $carYear_arr)) ? "checked" : "";?>/>2011 <br />
            <input type="checkbox" name="carYear[]" value="2012" <?php echo (!empty($carYear_arr) && in_array("2012", $carYear_arr)) ? "checked" : "";?>/>2012 <br />
            <input type="checkbox" name="carYear[]" value="2013" <?php echo (!empty($carYear_arr) && in_array("2013", $carYear_arr)) ? "checked" : "";?>/>2013 <br />
            <input type="checkbox" name="carYear[]" value="2014" <?php echo (!empty($carYear_arr) && in_array("2014", $carYear_arr)) ? "checked" : "";?>/>2014 <br />
            <input type="checkbox" name="carYear[]" value="2015" <?php echo (!empty($carYear_arr) && in_array("2015", $carYear_arr)) ? "checked" : "";?>/>2015 <br />
            <input type="checkbox" name="carYear[]" value="2016" <?php echo (!empty($carYear_arr) && in_array("2016", $carYear_arr)) ? "checked" : "";?>/>2016 <br />
            <input type="checkbox" name="carYear[]" value="2017" <?php echo (!empty($carYear_arr) && in_array("2017", $carYear_arr)) ? "checked" : "";?>/>2017 <br />
            <input type="checkbox" name="carYear[]" value="2018" <?php echo (!empty($carYear_arr) && in_array("2018", $carYear_arr)) ? "checked" : "";?>/>2018 <br />
            <input type="checkbox" name="carYear[]" value="2019" <?php echo (!empty($carYear_arr) && in_array("2019", $carYear_arr)) ? "checked" : "";?>/>2019 <br />
            <input type="checkbox" name="carYear[]" value="2020" <?php echo (!empty($carYear_arr) && in_array("2020", $carYear_arr)) ? "checked" : "";?>/>2020 <br />
            <input type="checkbox" name="carYear[]" value="2021" <?php echo (!empty($carYear_arr) && in_array("2021", $carYear_arr)) ? "checked" : "";?>/>2021 <br />
            <input type="checkbox" name="carYear[]" value="2022" <?php echo (!empty($carYear_arr) && in_array("2022", $carYear_arr)) ? "checked" : "";?>/>2022 <br />
            <input type="checkbox" name="carYear[]" value="2023" <?php echo (!empty($carYear_arr) && in_array("2023", $carYear_arr)) ? "checked" : "";?>/>2023 <br />
        </fieldset>

    <fieldset>
        <input type="text" id="carMake_error" class ="error" size = "40" value="<?php echo $carMake_error; ?>">
        <legend>Select the Make of Your Car: </legend>
        <br />
        <input type="checkbox" name="carMake[]" value="Acura" <?php echo (!empty($carMake_arr) && in_array("Acura", $carMake_arr))  ? "checked" : "";?>/>Acura <br />
        <input type="checkbox" name="carMake[]" value="Audi" <?php echo (!empty($carMake_arr) && in_array("Audi", $carMake_arr)) ? "checked" : "";?>/>Audi <br />
        <input type="checkbox" name="carMake[]" value="BMW" <?php echo (!empty($carMake_arr) && in_array("BMW", $carMake_arr)) ? "checked" : "";?>/>BMW <br />
        <input type="checkbox" name="carMake[]" value="Buick" <?php echo (!empty($carMake_arr) && in_array("Buick", $carMake_arr)) ? "checked" : "";?>/>Buick <br />
        <input type="checkbox" name="carMake[]" value="Cadillac" <?php echo (!empty($carMake_arr) && in_array("Cadillac", $carMake_arr)) ? "checked" : "";?>/>Cadillac <br />
        <input type="checkbox" name="carMake[]" value="Chevrolet" <?php echo (!empty($carMake_arr) && in_array("Chevrolet", $carMake_arr)) ? "checked" : "";?>/>Chevrolet <br />
        <input type="checkbox" name="carMake[]" value="Dodge" <?php echo (!empty($carMake_arr) && in_array("Dodge", $carMake_arr)) ? "checked" : "";?>/>Dodge <br />
        <input type="checkbox" name="carMake[]" value="Ford" <?php echo (!empty($carMake_arr) && in_array("Ford", $carMake_arr)) ? "checked" : "";?>/>Ford <br />
        <input type="checkbox" name="carMake[]" value="GMC" <?php echo (!empty($carMake_arr) && in_array("GMC", $carMake_arr)) ? "checked" : "";?>/>GMC <br />
        <input type="checkbox" name="carMake[]" value="Honda" <?php echo (!empty($carMake_arr) && in_array("Honda", $carMake_arr)) ? "checked" : "";?>/>Honda <br />
        <input type="checkbox" name="carMake[]" value="Hyundai" <?php echo (!empty($carMake_arr) && in_array("Hyundai", $carMake_arr)) ? "checked" : "";?>/>Hyundai <br />
        <input type="checkbox" name="carMake[]" value="Infiniti" <?php echo (!empty($carMake_arr) && in_array("Infiniti", $carMake_arr)) ? "checked" : "";?>/>Infiniti <br />
        <input type="checkbox" name="carMake[]" value="Jaguar" <?php echo (!empty($carMake_arr) && in_array("Jaguar", $carMake_arr)) ? "checked" : "";?>/>Jaguar <br />
        <input type="checkbox" name="carMake[]" value="Jeep" <?php echo (!empty($carMake_arr) && in_array("Jeep", $carMake_arr)) ? "checked" : "";?>/>Jeep <br />
        <input type="checkbox" name="carMake[]" value="Kia" <?php echo (!empty($carMake_arr) && in_array("Kia", $carMake_arr)) ? "checked" : "";?>/>Kia <br />
        </fieldset>

        <fieldset>
        <input type="text" id="carModel_error" class ="error" size = "40" value="<?php echo $carModel_error; ?>">
        <legend>Select the Model of Your Car: </legend>
        <br />
        <input type="checkbox" name="carModel[]" value="Accord" <?php echo (!empty($carModel_arr) && in_array("Accord", $carModel_arr)) ? "checked" : "";?>/>Accord <br />
        <input type="checkbox" name="carModel[]" value="Altima" <?php echo (!empty($carModel_arr) && in_array("Altima", $carModel_arr)) ? "checked" : "";?>/>Altima <br />
        <input type="checkbox" name="carModel[]" value="Camry" <?php echo (!empty($carModel_arr) && in_array("Camry", $carModel_arr)) ? "checked" : "";?>/>Camry <br />
        <input type="checkbox" name="carModel[]" value="Civic" <?php echo (!empty($carModel_arr) && in_array("Civic", $carModel_arr)) ? "checked" : "";?>/>Civic <br />
        <input type="checkbox" name="carModel[]" value="Corolla" <?php echo (!empty($carModel_arr) && in_array("Corolla", $carModel_arr)) ? "checked" : "";?>/>Corolla <br />
        <input type="checkbox" name="carModel[]" value="CR-V" <?php echo (!empty($carModel_arr) && in_array("CR-V", $carModel_arr)) ? "checked" : "";?>/>CR-V <br />
        <input type="checkbox" name="carModel[]" value="Elantra" <?php echo (!empty($carModel_arr) && in_array("Elantra", $carModel_arr)) ? "checked" : "";?>/>Elantra <br />
        <input type="checkbox" name="carModel[]" value="Escape" <?php echo (!empty($carModel_arr) && in_array("Escape", $carModel_arr)) ? "checked" : "";?>/>Escape <br />
        <input type="checkbox" name="carModel[]" value="Fusion" <?php echo (!empty($carModel_arr) && in_array("Fusion", $carModel_arr)) ? "checked" : "";?>/>Fusion <br />
        <input type="checkbox" name="carModel[]" value="Impala" <?php echo (!empty($carModel_arr) && in_array("Impala", $carModel_arr)) ? "checked" : "";?>/>Impala <br />
        <input type="checkbox" name="carModel[]" value="Malibu" <?php echo (!empty($carModel_arr) && in_array("Malibu", $carModel_arr)) ? "checked" : "";?>/>Malibu <br />
        <input type="checkbox" name="carModel[]" value="Maxima" <?php echo (!empty($carModel_arr) && in_array("Maxima", $carModel_arr)) ? "checked" : "";?>/>Maxima <br />
        <input type="checkbox" name="carModel[]" value="Mustang" <?php echo (!empty($carModel_arr) && in_array("Mustang", $carModel_arr)) ? "checked" : "";?>/>Mustang <br />
        <input type="checkbox" name="carModel[]" value="Optima" <?php echo (!empty($carModel_arr) && in_array("Optima", $carModel_arr)) ? "checked" : "";?>/>Optima <br />
        <input type="checkbox" name="carModel[]" value="Passat" <?php echo (!empty($carModel_arr) && in_array("Passat", $carModel_arr)) ? "checked" : "";?>/>Passat <br />
        <input type="checkbox" name="carModel[]" value="Prius" <?php echo (!empty($carModel_arr) && in_array("Prius", $carModel_arr)) ? "checked" : "";?>/>Prius <br />
        <input type="checkbox" name="carModel[]" value="Rav4" <?php echo (!empty($carModel_arr) && in_array("Rav4", $carModel_arr)) ? "checked" : "";?>/>Rav4 <br />
        <input type="checkbox" name="carModel[]" value="Sentra" <?php echo (!empty($carModel_arr) && in_array("Sentra", $carModel_arr)) ? "checked" : "";?>/>Sentra <br />
        <input type="checkbox" name="carModel[]" value="Sonata" <?php echo (!empty($carModel_arr) && in_array("Sonata", $carModel_arr)) ? "checked" : "";?>/>Sonata <br />
        <input type="checkbox" name="carModel[]" value="Tucson" <?php echo (!empty($carModel_arr) && in_array("Tucson", $carModel_arr)) ? "checked" : "";?>/>Tucson <br />
        <input type="checkbox" name="carModel[]" value="Versa" <?php echo (!empty($carModel_arr) && in_array("Versa", $carModel_arr)) ? "checked" : "";?>/>Versa <br />
        <input type="checkbox" name="carModel[]" value="Yaris" <?php echo (!empty($carModel_arr) && in_array("Yaris", $carModel_arr)) ? "checked" : "";?>/>Yaris <br />
        </fieldset>

    </p>
    <p>
        <input type = "submit" name="addCar" value = "Find Car Value" />&nbsp;&nbsp;
        <input type="reset" name="reset" value="Reset" />
    </p>
</form>

<?php
}
?>
