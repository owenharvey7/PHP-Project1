<?php
session_start();
/*
 * The final value of the car is based on the condition of the car. For instance, you may assume that the car
price stored in the database table represents a base price for a car with a “Fair” condition.
*However, the user should be able to choose a different condition and the final car value should increase.
 * You must have the following car conditions (Excellent, Very Good, Good, and Fair).
 * For instance, you may assume that a car with Good condition is 5% more than the base price, and so on.
 * Base price adjustment: The mileage determines how much the base price of a car will be reduced.
 * You may follow a simple calculations procedure as follows:
    * 0-10k miles: final price will be similar to the base price stored about the car in the database.
    * 11k – 40k: 5% less
    * 40 – 100k: 10% less
    * 100k+: 15% less
 * Options: provide a list of at least 5 desirable options, each of which will add a fixed value ($50) to the car price.
 * For simplicity, you may assume that all options are uniform to all cars.
 */

//use the $basePrice variable to calculate the final value of the car from Test.php
require "Test.php";

//get $basePrice from Test.php
$basePrice = $_SESSION['basePrice'];

$finalPrice = 0;
$carCondition_arr = array(
        "Excellent" => "Excellent",
        "Very Good" => "Very Good",
        "Good" => "Good",
        "Fair" => "Fair");

$carMileage_arr = array(
    "0-10k" => "0-10k",
    "11k-40k" => "11k-40k",
    "40k-100k" => "40k-100k",
    "100k+" => "100k+");

if (isset($_POST['submit-button'])) {

    //create variables for mileage and condition
    $carCondition = $_POST['carCondition'];
    $carMileage = $_POST['carMileage'];

    //if statement for converting arrays to percent values
    if($carCondition == "Excellent"){
        $carCondition = 1.15;
    }
    elseif($carCondition == "Very Good"){
        $carCondition = 1.10;
    }elseif($carCondition == "Good"){
        $carCondition = 1.05;
    }elseif($carCondition == "Fair"){
        $carCondition = 1.00;
    }

    if($basePrice == "0-10k"){
        $basePrice = 1.00;
    }
    elseif($basePrice == "11k-40k"){
        $basePrice = 0.95;
    }elseif($basePrice == "40k-100k"){
        $basePrice = 0.90;
    }elseif($basePrice == "100k+"){
        $basePrice = 0.85;
    }

    $basePrice = $basePrice * $carCondition;

    $basePrice = $basePrice * $carMileage;

    $finalPrice = $basePrice;


}

?>
<h2><center>Use the checkboxes to help us better value your vehicle:</center></h2>
<form method="post" action="Display%20Values.php">

<fieldset>
    <legend>Select the condition of your Vehicle:</legend>
    <select name = 'carModel'>
        <?php
        foreach ($carCondition_arr as $key => $value) {
            $checked = (!empty($carCondition_arr) && in_array($key, $carCondition_arr)) ? "checked" : "";
            echo "<option type='checkbox' name='carCondition[]' value='$key' checked=$checked >$value</option>";
        }
        ?>
    </select>

</fieldset>

    <fieldset>
        <legend>Select the mileage of your Vehicle:</legend>
        <select name = 'carModel'>
            <?php
            foreach ($carMileage_arr as $key => $value) {
                $checked = (!empty($carMileage_arr) && in_array($key, $carMileage_arr)) ? "checked" : "";
                echo "<option type='checkbox' name='carMileage[]' value='$key' checked=$checked >$value</option>";
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