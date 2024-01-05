<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link href="./style.css" rel="stylesheet">
    <title>Your fancy store</title>
<style>
    .result{
        width: 50%;
        margin: 0 auto;
        padding: 3%;
        display: flex;
    }

    #orderDetails {
        width: 50%;
        position: relative;
        padding: 20px;
        background-color: wheat;
    }

    .orderdetails,
    .adressdetails {
        margin-bottom: 10%;
        border: 1px solid dimgray;
    }
    .deliverytime{
        width: 50%;
        text-align: center;
        padding-top: 20px;
        margin: 0 auto;
        background-color: wheat;
    }
    .btn-sbmt{
        position: relative;
        top:-4.5rem;
    }


</style>
</head>
<body>
<div class="container">
<?php // Navigation for when you need it ?>

<div class="logo">
    <a href="#" title="Logo">
        <img src="./images/logo.png" alt="Restaurant Logo" class="img-responsive">
    </a>
</div>

<nav>
    <div class="menu">
        <ul class="nav ">
            <li class="nav-item">
                <a class="nav-link active" href="./food.php">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./drinks.php">Order drinks</a>
            </li>
        </ul>
    </div>
</nav>
<?php // End of Navigation ?>

</div>

</body>
</html>
<?php


// This file is your starting point (= since it's the index)
// It will contain most of the logic, to prevent making a messy mix in the html

// This line makes PHP behave in a more strict way


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
    ['name' => 'Margerita', 'price' => 2.5, 'img' =>"./images/pizza.jpg"],
    ['name' => '4 Sessions', 'price' => 2, 'img' =>"./images/pizza.jpg"],
    ['name' => 'Hawaii', 'price' => 2.5, 'img' =>"./images/pizza.jpg"],
    ['name' => 'Barbeque', 'price' => 3.7, 'img' =>"./images/pizza.jpg"],
    ['name' => 'Bolognese', 'price' => 1, 'img' =>"./images/pizza.jpg"],
];

$foods = [
    ['name' => 'X', 'price' => 2.5],
    ['name' => 'Y', 'price' => 2],
    ['name' => 'Z', 'price' => 2.5],
    ['name' => 'Q', 'price' => 3.7],
    ['name' => 'A', 'price' => 1],
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

    function calculateTotal($selectedProducts, $products)
    {
        foreach ($selectedProducts as $productIndex => $value) {
            if (isset($products[$productIndex])) {
                $totalValue += $products[$productIndex]['price'];
            }
        }

        return $totalValue;
    }


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

// Check if the user is updating express delivery
        $updatingExpressDelivery = isset($_POST['update']);

        // Inside the handleForm function, after validating and before displaying the order details
        if (empty($errors) || $updatingExpressDelivery) {
            // Display the submitted data


            echo "<h1 class='confirmation'>Confirm your order:</h1>";

            // Default delivery time
            $defaultDeliveryTime = 2;

            // Initialize additional cost and time for express delivery
            $expressDeliveryCost = 5;
            $expressDeliveryTime = 45;

            // Check if the user opted for express delivery
            $expressDeliverySelected = isset($_POST['express_delivery']);



            // Adjust the duration for express delivery
            if ($expressDeliverySelected) {
                $_SESSION['express_delivery'] = true;
                $_SESSION['duration'] = min($defaultDeliveryTime * 60 - $expressDeliveryTime, $defaultDeliveryTime * 60); // Express delivery in 45 minutes
            } else {
                // If checkbox is not selected, set express delivery to false
                $_SESSION['express_delivery'] = false;
                $_SESSION['duration'] = $defaultDeliveryTime * 60; // Default delivery time
            }





            echo "<p class='deliverytime'>The expected delivery time: <strong>". "<br>". ($_SESSION['express_delivery'] || $expressDeliverySelected ? '45 minutes (Express)' : "{$defaultDeliveryTime} hours") . " </strong><br>  + €5 </p>";
            echo '<div id="orderDetails" class="result">';

            echo '<div id="orderDetails" class="orderdetails">';
            echo "<h4>Order Details:</h4>";
            // Get the indices of selected products
            $selectedIndices = array_keys($formData['products']);

            // Initialize express delivery cost
            $expressDeliveryCost = $expressDeliverySelected ? 5 : 0;

            // Iterate through selected indices and display corresponding product names
            foreach ($selectedIndices as $productIndex) {
                if (isset($products[$productIndex])) {
                    $productName = $products[$productIndex]['name'];
                    $productPrice = $products[$productIndex]['price'];
                    $productImage = $products[$productIndex]['img'];

                    echo "<p>" . $productName . " - &euro;" . number_format($productPrice, 2) . $productImage . "</p>";
                }
            }


            // Calculate and display the total value in the footer
            // Update total amount for express delivery
            $totalValue = calculateTotal($formData['products'], $products);

            // Update total amount for express delivery
            if ($_SESSION['express_delivery'] && $expressDeliverySelected) {
                $totalValue += $expressDeliveryCost;
            }

            echo "<h3>Total: <strong>&euro; " . number_format($totalValue, 2) . "</strong> </h3>";


            echo '</div>';
            echo "<br>";
            echo '<div id="orderDetails" class="adressdetails">';
            echo "<h4>Adress Details:</h4>";
            // Display other details like street, street number, city, zipcode, and email
            echo "<p>Street: " . $formData['street'] . "</p>";
            echo "<p>Street number: " . $formData['streetnumber'] . "</p>";
            echo "<p>City: " . $formData['city'] . "</p>";
            echo "<p>Zipcode: " . $formData['zipcode'] . "</p>";
            echo "<p>E-mail: " . $formData['email'] . "</p>";
            echo '</div>';
            echo '</div>';
            echo "<button type='submit' name='submit' class='btn btn-sbmt btn-success'>OK</button>";
            echo "<br>";

            updateStatistics($formData['products'], $products);

            if (isset($_POST['submit'])) {
                echo "<p>Your order is on the way!</p>";
            }
        }
    }

// Function to update statistics
    function updateStatistics($selectedProducts, $allProducts)
    {
        global $totalValue, $totalNumberOfProducts, $topProduct, $orders;

        // Calculate total value
        $totalValue += calculateTotal($selectedProducts, $allProducts);

        // Update total number of products
        $totalNumberOfProducts += count($selectedProducts);

        // Update top product
        $topProduct = getTopProduct($selectedProducts, $allProducts);

        // Update orders
        updateOrders($selectedProducts);
    }

// Function to update orders
    function updateOrders($selectedProducts)
    {
        global $orders;

        // Update orders with selected products
        foreach ($selectedProducts as $productIndex => $value) {
            if (isset($orders[$productIndex])) {
                $orders[$productIndex]['amount'] += 1;
            } else {
                $orders[$productIndex] = [
                    'product' => $productIndex,
                    'amount' => 1,
                ];
            }
        }

        // Save orders in the session
        $_SESSION['orders'] = $orders;
    }


// Check if the user is updating express delivery
    $updatingExpressDelivery = isset($_POST['update']);
// Display error messages at the top of the form
    if (!empty($errors)  && !$updatingExpressDelivery) {
        $_SESSION['user_data'] = [
            'email' => $formData['email'],
            'street' => $formData['street'],
            'streetnumber' => $formData['streetnumber'],
            'city' => $formData['city'],
            'zipcode' => $formData['zipcode'],
        ];
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
?>
