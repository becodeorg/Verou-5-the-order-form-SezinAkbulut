
<!DOCTYPE html>
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
    body{
        height: 100vh;
        overflow-y: hidden;
    }
    .text {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 100vh;
        padding-top: 20px;
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

    <div class="container">
        <div class="text">
        <h1>Your order is on the way!</h1> <br>
        <br>
        <p class="text-center">Thank you for ordering from Home Delivery. <br>
            Your delicious food will be delivered shortly.</p>
        </div>
    </div>
</body>
</html>
