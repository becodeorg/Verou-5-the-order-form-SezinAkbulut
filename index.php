<?php

// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way
declare(strict_types=1);

// We are going to use session variables so we need to enable sessions
session_start();

// Use this function when you need to need an overview of these variables
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

// TODO: provide some products (you may overwrite the example)
$products = [
    ['name' => 'Ice Tea', 'price' => 2.5],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Coca Cola', 'price' => 2.5],
    ['name' => 'Spritz', 'price' => 3.7],
    ['name' => 'Water', 'price' => 1],
];

$totalValue = 0;

function validate()
{
    // TODO: This function will send a list of invalid fields back
    return [];
}

function handleForm($products)
{
    // TODO: form related tasks (step 1)
    //var_dump($_SERVER["REQUEST_METHOD"]);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = htmlspecialchars($_POST["email"]);
        $street = htmlspecialchars($_POST["street"]);
        $streetnumber = htmlspecialchars($_POST["streetnumber"]);
        $city = htmlspecialchars($_POST["city"]);
        $zipcode = htmlspecialchars($_POST["zipcode"]);
        $selectedProducts = $_POST["products"] ; // Use the correct name for the checkboxes

        if (empty($email)) {
            // Redirect or handle the error appropriately
            header("location: ./form-view.php");
            exit();
        }

        echo "Your order is submitted:";
        echo "<br>";

        // Get the indices of selected products
        $selectedIndices = array_keys($selectedProducts);

        // Iterate through selected indices and display corresponding product names
        foreach ($selectedIndices as $productIndex) {
            if (isset($products[$productIndex])) {
                echo $products[$productIndex]['name'] . "<br>";
            }
        }
        echo "<br>";
        echo $street;
        echo "<br>";
        echo $streetnumber;
        echo "<br>";
        echo $city;
        echo "<br>";
        echo $zipcode;
        echo "<br>";
        echo $email;
}


    // Validation (step 2)
    $invalidFields = validate();
    if (!empty($invalidFields)) {
        // TODO: handle errors
    } else {
        // TODO: handle successful submission
    }
}

// TODO: replace this if by an actual check for the form to be submitted
$formSubmitted = true;
if ($formSubmitted) {
    handleForm($products);
}

require 'form-view.php';