<?php $products = [
    ['name' => 'Ice Tea', 'price' => 2.5],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Coca Cola', 'price' => 2.5],
    ['name' => 'Spritz', 'price' => 3.7],
    ['name' => 'Water', 'price' => 1],
];
?>

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
                    <a class="nav-link active" href="./food.php">Food</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./drinks.php">Drinks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.html">Home</a>
                </li>
            </ul>
        </div>
    </nav>
    <?php // End of Navigation ?>



    <div>
        <legend>Products</legend>
        <?php foreach ($products as $i => $product): ?>
            <label class="product-label">
                <input class="product-info" type="checkbox" value="1" name="products[<?php echo $i ?>]" />
                <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                <span class="product-info">
                <span class="product-name"><?php echo $product['name'] ?></span> -
                &euro; <?= number_format($product['price'], 2) ?>
            </span>
            </label><br />

        <?php endforeach; ?>
    </div>
</div>

</body>
</html>



