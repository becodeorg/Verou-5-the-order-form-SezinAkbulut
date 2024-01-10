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
            width: 70%;
            border-radius: %60;
            position: relative;
            padding: 20px;
            background-color: wheat;
        }
        .orderdetails,
        .adressdetails {
            margin-bottom: 10%;
            border: 1px solid dimgray;
            height: 700px;
            border-radius: %60;
            display: block;
        }
        p.orderdetails,
        p.adressdetails {
            text-align: left;
        }
        .selected-product-image{
            float: right;
            margin-left: 10px;
            max-width: 80px;
        }
        .product-img{
            height: 100px;
        }
        .deliverytime{
            width: 50%;
            text-align: center;
            margin: 0 auto;
            position: relative;
            top:-7rem;
        }
        .btn-sbmt{
            margin-top: -4rem;
            margin-bottom: 2rem;
        }
    </style>

</head>
<body>
<div class="container">
    <?php // Navigation for when you need it ?>

    <div class="logo">
        <a href="#" title="Logo">
            <img src="./images/logo.png" alt="Restaurant Logo" class="img-responsive-1">
        </a>
    </div>

    <nav>
        <div class="menu">
            <ul class="nav ">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php // End of Navigation ?>

</div>

</body>
</html>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

// Retrieve data from session
$confirmationData = $_SESSION['confirmationData'] ?? null;


// Function to calculate total value
function calculateTotal($selectedProducts, $products, $totalValue)
{
    foreach ($selectedProducts as $productIndex => $value) {
        if (isset($products[$productIndex])) {
            $totalValue += $products[$productIndex]['price'];
        }
    }
    return $totalValue;
}

// Check if data is available
if ($confirmationData) {
    $formData = $confirmationData['formData'];
    $totalValue = $confirmationData['totalValue'];
    $expressDeliveryCost = $confirmationData['expressDeliveryCost'];
    $expressDeliverySelected = $confirmationData['express_delivery'];
    $products = $confirmationData['products'];

// Display confirmation details
echo "<form method='post' action='order-success.php'>";
echo "<h1 class='confirmation'>Confirm your order:</h1>";

// Default delivery time
$defaultDeliveryTime = 2;

// Initialize additional cost and time for express delivery
$expressDeliveryTime = 45;

// Check if the user opted for express delivery
$expressDeliverySelected = isset($_POST['express_delivery']);
// Adjust the duration for express delivery
    if ($expressDeliverySelected) {
        $expressDeliveryCost = 5; // Express delivery cost
        $_SESSION['express_delivery'] = true;
        $_SESSION['duration'] = min($defaultDeliveryTime * 60 - $expressDeliveryTime, $defaultDeliveryTime * 60); // Express delivery in 45 minutes
    } else {
        $expressDeliveryCost = 0; // No express delivery cost
        // If checkbox is not selected, set express delivery to false
        $_SESSION['express_delivery'] = false;
        $_SESSION['duration'] = $defaultDeliveryTime * 60; // Default delivery time
    }


echo '<div id="orderDetails" class="result">';

echo '<div id="orderDetails" class="orderdetails">';
echo "<h4>Order Details:</h4>";
// Get the indices of selected products
$selectedIndices = array_keys($formData['products']);
    $updatingExpressDelivery = isset($_POST['update']);
// Initialize express delivery cost
$expressDeliveryCost = $expressDeliverySelected ? 5 : 0;

// Iterate through selected indices and display corresponding product names
foreach ($selectedIndices as $productIndex) {
    if (isset($products[$productIndex])) {
        $productName = $products[$productIndex]['name'];
        $productPrice = $products[$productIndex]['price'];
        $productImage = $products[$productIndex]['img'];

        echo "<p class='product-img'>" . $productName . " - &euro;" . number_format($productPrice, 2) . "<img src='{$productImage}' alt='{$productName}' class='selected-product-image'></p>";
    }
}


// Calculate and display the total value in the footer
// Update total amount for express delivery
/*
$totalValue = calculateTotal($formData['products'], $products, $totalValue);

// Update total amount for express delivery
if ($_SESSION['express_delivery'] && $expressDeliverySelected) {
    $totalValue += $expressDeliveryCost;
}
*/

echo "<h3>Total: <strong>&euro; " . number_format($totalValue, 2) . "</strong> </h3>";


echo '</div>';
echo "<br>";
echo '<div id="orderDetails" class="adressdetails">';
echo "<h4>Adress Details:</h4>";
// Display other details like street, street number, city, zipcode, and email
echo "<p> <strong>Street:</strong> " . $formData['street'] . "</p>";
echo "<p> <strong>Street number:</strong> " . $formData['streetnumber'] . "</p>";
echo "<p> <strong>City: </strong>" . $formData['city'] . "</p>";
echo "<p> <strong>Zipcode: </strong>" . $formData['zipcode'] . "</p>";
echo "<p> <strong>E-mail: </strong>" . $formData['email'] . "</p>";
echo '</div>';
echo '</div>';

echo "<br>";
echo "<p class='deliverytime'>The expected delivery time: <strong>". "<br>". ($_SESSION['express_delivery'] || $expressDeliverySelected ? '45 minutes (Express)' . "<br>" . "&euro;" . $expressDeliveryCost : "{$defaultDeliveryTime} hours") . "  </strong> </p>";

echo "<button type='submit' name='submit' class='btn btn-sbmt btn-success'>ORDER</button>";
echo "<br>";
echo  "</form>";


unset($_SESSION['confirmationData']);


/*if (isset($_POST['submit'])) {
    echo "<p>Your order is on the way!</p>";
}
*/
} else {

    // Redirect to order-success.php
    header("Location: order-success.php");
    exit;

}



