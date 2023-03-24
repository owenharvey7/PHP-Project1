<?php
session_start();
$displayform1 = true;

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

if (isset($_POST['submit_button'])) {

    //create variables for mileage and condition
    $carCondition = $_POST['carCondition'];
    $carMileage = $_POST['carMileage'];

    echo "<h4>The car condition is: $carCondition</h4>";
    echo "<h4>The car mileage is: $carMileage</h4>";
    echo "<h4>The original base price of your Vehicle was: $basePrice</h4>";

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

    if($carMileage == "0-10k"){
        $carMileage = 1.00;
    }
    elseif($carMileage == "11k-40k"){
        $carMileage = 0.95;
    }elseif($carMileage == "40k-100k"){
        $carMileage = 0.90;
    }elseif($carMileage == "100k+"){
        $carMileage = 0.85;
    }else{
        "No value was selected.";
    }

    $basePrice = $basePrice * $carCondition;

    $basePrice = $basePrice * $carMileage;

    $finalPrice = $basePrice;

    //put the $finalPrice into a table and display it
    //display car value if sold to a private owner, suggested retail price (15% more than suggested retail), and certified pre-owned value (10% over
    //private owner value).

    $privateOwner = $finalPrice * 1.15;
    $suggestedRetail = $finalPrice;
    $certifiedPreOwned = $finalPrice * 1.25;

    echo "<center><h4>Car Values Depending on Vendor With Provided Information:</h4></center>";
    echo "<table width='100%' border='1'>";
    echo "<tr><th>Private Owner</th><th>Suggested Retail</th><th>Certified Pre-Owned</th></tr>";
    echo "<tr><td>$", $privateOwner, "</td><td>$", $suggestedRetail, "</td><td>$", $certifiedPreOwned, "</td></tr>";
    echo "</table>";

    $displayform1 = false;



    echo "<br><p><a href=\"Get%20Red%20Book%20Value.php\">Look for another car value</a></p>\n";
}

if ($displayform1){
?>
<h2><center>Use the checkboxes to help us better value your vehicle:</center></h2>
<form method="post" action="Display%20Values.php">

<fieldset>
    <legend>Select the condition of your Vehicle:</legend>
    <select name = 'carCondition'>
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
        <select name = 'carMileage'>
            <?php
            foreach ($carMileage_arr as $key => $value) {
                $checked = (!empty($carMileage_arr) && in_array($key, $carMileage_arr)) ? "checked" : "";
                echo "<option type='checkbox' name='carMileage[]' value='$key' checked=$checked >$value</option>";
            }
            ?>
        </select>

    </fieldset>

<br><br>
<input type="submit" name="submit_button"/>
<input type="reset" name="reset" value="Reset"/>

</form>

</body>

</html>
<?php
}
?>