<?php // This file is mostly containing things for your view / html ?>

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

    <h1>Place your order</h1>
    <div>

    <form method="POST" id="orderForm">

        <div class="form-row justify-content-center"">
            <div class="form-group col-md-6">
                <label class="order-label"  for="email" placeholder="example@gmail.com" >E-mail:</label>
                <input required type="email" id="email" name="email" class="form-control <?php echo (!empty($errors) && !empty($errors['email'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['email']) ? $_SESSION['user_data']['email'] : ''; ?>"/>
                <?php if (!empty($errors) && !empty($errors['email'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            <div></div>
        </div>



            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="order-label"  for="street" >Street:</label>
                    <input  required type="text" name="street" id="street" class="form-control <?php echo (!empty($errors) && !empty($errors['street'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['street']) ? $_SESSION['user_data']['street'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['street'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['street']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-6">
                    <label class="order-label"  for="streetnumber">Street number:</label>
                    <input  required type="text" id="streetnumber" name="streetnumber" class="form-control <?php echo (!empty($errors) && !empty($errors['streetnumber'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['streetnumber']) ? $_SESSION['user_data']['streetnumber'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['streetnumber'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['streetnumber']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="order-label"  for="city">City:</label>
                    <input  required type="text" id="city" name="city" class="form-control <?php echo (!empty($errors) && !empty($errors['city'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['city']) ? $_SESSION['user_data']['city'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['city'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['city']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group  col-md-6">
                    <label class="order-label" for="zipcode">Zipcode</label>
                    <input  required type="text" id="zipcode" name="zipcode" class="form-control <?php echo (!empty($errors) && !empty($errors['zipcode'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['zipcode']) ? $_SESSION['user_data']['zipcode'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['zipcode'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['zipcode']; ?></div>
                    <?php endif; ?>
                </div>

            </div>


        <div>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label class="product-label">
                    <input class="product-info" type="checkbox" value="1" name="products[<?php echo $i ?>]" />
                    <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['name']; ?>" class="product-image">
                    <span class="product-info">
                <span class="product-name"><?php echo $product['name'] ?></span> - <span class="food-price">
                &euro; <?= number_format($product['price'], 2) ?></span>
            </span>
                </label><br />

            <?php endforeach; ?>
        </div>

    <br>
    <form method='post' action="confirmation.php">
        <label for="express_delivery">The expected delivery time: 2 hours </label> <br>
        <input type="checkbox" value="1" name="express_delivery" id="express_delivery"/> Express for delivery in 45 minute for &euro; 5 .</label><br>

        <br>
        <button type="submit" class="btn btn-submit btn-primary">Order!</button>
    </form>

<br>

</div>



</body>
</html>




