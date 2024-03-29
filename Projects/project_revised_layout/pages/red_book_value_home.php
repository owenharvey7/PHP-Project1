<?php
include '../static/imports/header.php';
include '../static/imports/footer.php';
// Connect to MySQL Server
require_once '../components/db_login.php';


html_header("Ron's Red Book Appraisal");

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

    $table = $table = "<table width='100%' border='1'>";

    $table .= "<tr><th>Make</th><th>Model</th><th>Year</th><th>Value</th></tr>";

    //if statement for if the car is in the database
    if ($result->rowCount() > 0) {
        //variable to store $row['base_price']
        $basePrice = 0;

        echo "<center><h4><br><br>There is a ", $carYear, " ", $carMake, " ", $carModel, " in our database:</h4></center>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $basePrice = $row['base_price'];
            $table .= "<tr><td>" . $row['make'] . "</td><td>" . $row['model'] . "</td><td>" . $row['year'] . "</td><td>" . $row['base_price'] . "</td></tr>";
        }
        $table .= "</table>";
        echo $table;
        $displayform = false;

        //start session
        session_start();

        //send the value of $basePrice to the Display Values.php
        $_SESSION['basePrice'] = $basePrice;


        //call on and display Display Values.php
        include_once 'Display Values.php';


        //display car value if sold to a private owner, suggested retail price (15% more than suggested retail), and certified pre-owned value (10% over
        //private owner value).
        echo "<center><h4>Car Values Depending on Vendor:</h4></center>";

        $privateOwner = $basePrice * .85;
        $suggestedRetail = $basePrice * 1.15;
        $certifiedPreOwned = $basePrice * 1.10;

        //show values in a table
        echo "<table width='100%' border='1'>";
        echo "<tr><th>Private Owner</th><th>Suggested Retail</th><th>Certified Pre-Owned</th></tr>";
        echo "<tr><td>$", $privateOwner, "</td><td>$", $suggestedRetail, "</td><td>$", $certifiedPreOwned, "</td></tr>";
        echo "</table>";


        //search a new car
        echo "<br><p><a href=\"Test.php\">Look for another car value</a></p>\n";


    } else {
        echo "<br><br>There is no ", $carYear, " ", $carMake, " ", $carModel, " in our database.";
        $displayform = false;
    }


} else {
    "Please enter a valid year, make, and model.";

}

if ($displayform) {
    ?>

    <h2>
        <center>Use the following form to find the value of your Vehicle:</center>
    </h2>
    <div class="row">
        <div class="col-12 col-lg-6 mx-auto">
            <div class="card shadow">
                <div class="card-header p-3">
                    <h2>Vehicle Value</h2>
                </div>
                <div class="card-body">

                    <form method="post">
                        <fieldset>
                            <legend>Enter the Year of Your Vehicle:</legend>
                            <select name='carYear'>
                                <?php
                                foreach ($carYear_arr as $key => $value) {
                                    $checked = (!empty($carYear_arr) && in_array($key, $carYear_arr)) ? "checked" : "";
                                    echo "<option type='checkbox' name='carYear' value='$key' checked=$checked >$value</option>";
                                }
                                ?>
                            </select>
                        </fieldset>


                        <fieldset>
                            <legend>Select the Make of Your Vehicle:</legend>
                            <select name=carMake>
                                <?php
                                foreach ($carMake_arr as $key => $value) {
                                    $checked = (!empty($carMake_arr) && in_array($key, $carMake_arr)) ? "checked" : "";
                                    echo "<option type='checkbox' name='carMake[]' value='$key' checked=$checked >$value</option>";
                                }
                                ?>
                            </select>
                        </fieldset>


                        <fieldset>
                            <legend>Select the Model of Your Vehicle:</legend>
                            <select name='carModel'>
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

                </div>
            </div>
        </div>
    </div>


    <?php
}



html_footer();


?>