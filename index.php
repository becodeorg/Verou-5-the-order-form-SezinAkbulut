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

    // Initialize variables to store form data and error messages
    $formData = [
        'email' => '',
        'street' => '',
        'streetnumber' => '',
        'city' => '',
        'zipcode' => '',
        'products' => [],
    ];

    $errors = [];

    // Initialize variables to store form data and error messages
    $formData = [
        'email' => '',
        'street' => '',
        'streetnumber' => '',
        'city' => '',
        'zipcode' => '',
        'products' => [],
    ];

    $errors = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate email
        $formData['email'] = htmlspecialchars($_POST["email"]);
        if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email address';
        }

        // Validate street
        $formData['street'] = htmlspecialchars($_POST["street"]);
        if (empty($formData['street'])) {
            $errors[] = 'Street is required';
        }

        // Validate street number
        $formData['streetnumber'] = htmlspecialchars($_POST["streetnumber"]);
        if (empty($formData['streetnumber'])) {
            $errors[] = 'Street number is required';
        }

        // Validate city
        $formData['city'] = htmlspecialchars($_POST["city"]);
        if (empty($formData['city'])) {
            $errors[] = 'City is required';
        }

        // Validate zip code
        $formData['zipcode'] = htmlspecialchars($_POST["zipcode"]);
        if (!ctype_digit($formData['zipcode'])) {
            $errors[] = 'Zipcode should contain only numbers';
        }

        // Validate selected products
        $formData['products'] = $_POST["products"] ?? [];
        if (empty($formData['products'])) {
            $errors[] = 'Select at least one product';
        }

        // If there are no errors, display the submitted data
        if (empty($errors)) {
            echo "Your order is submitted:";
            echo "<br>";

            // Get the indices of selected products
            $selectedIndices = array_keys($formData['products']);

            // Iterate through selected indices and display corresponding product names
            foreach ($selectedIndices as $productIndex) {
                if (isset($products[$productIndex])) {
                    echo $products[$productIndex]['name'] . "<br>";
                }
            }
            echo "<br>";
            echo $formData['street'] . "<br>";
            echo $formData['streetnumber'] . "<br>";
            echo $formData['city'] . "<br>";
            echo $formData['zipcode'] . "<br>";
            echo $formData['email'];
        }
    }
// Display error messages at the top of the form
    if (!empty($errors)) {
        echo '<div class="alert alert-danger" role="alert">';
        echo '<strong>Error!</strong> Please fix the following issues:<br>';
        foreach ($errors as $error) {
            echo '- ' . $error . '<br>';
        }
        echo '</div>';
    }


    // TODO: form related tasks (step 1)
    //var_dump($_SERVER["REQUEST_METHOD"]);

/*
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

*/
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