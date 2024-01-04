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
    <title>Your fancy store</title>
</head>
<body>
<div class="container">
    <h1>Place your order</h1>
    <?php // Navigation for when you need it ?>
    <nav>
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="?food=1">Order food</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?food=0">Order drinks</a>
            </li>
        </ul>
    </nav>
    <?php // End of Navigation ?>

    <form action="./index.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">E-mail:</label>
                <input required type="email" id="email" name="email" class="form-control <?php echo (!empty($errors) && !empty($errors['email'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['email']) ? $_SESSION['user_data']['email'] : ''; ?>"/>
                <?php if (!empty($errors) && !empty($errors['email'])): ?>
                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>
            <div></div>
        </div>

        <fieldset>
            <legend>Address</legend>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="street">Street:</label>
                    <input  required type="text" name="street" id="street" class="form-control <?php echo (!empty($errors) && !empty($errors['street'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['street']) ? $_SESSION['user_data']['street'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['street'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['street']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="streetnumber">Street number:</label>
                    <input  required type="text" id="streetnumber" name="streetnumber" class="form-control <?php echo (!empty($errors) && !empty($errors['streetnumber'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['streetnumber']) ? $_SESSION['user_data']['streetnumber'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['streetnumber'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['streetnumber']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="city">City:</label>
                    <input  required type="text" id="city" name="city" class="form-control <?php echo (!empty($errors) && !empty($errors['city'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['city']) ? $_SESSION['user_data']['city'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['city'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['city']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Zipcode</label>
                    <input  required type="text" id="zipcode" name="zipcode" class="form-control <?php echo (!empty($errors) && !empty($errors['zipcode'])) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_SESSION['user_data']['zipcode']) ? $_SESSION['user_data']['zipcode'] : ''; ?>"">
                    <?php if (!empty($errors) && !empty($errors['zipcode'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['zipcode']; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Products</legend>
            <?php foreach ($products as $i => $product): ?>
                <label>
					<?php // <?= is equal to <?php echo ?>
                    <input type="checkbox" value="1" name="products[<?php echo $i ?>]"/> <?php echo $product['name'] ?> -
                    &euro; <?= number_format($product['price'], 2) ?></label><br />
            <?php endforeach; ?>
        </fieldset>

        <button type="submit" class="btn btn-primary">Order!</button>
    </form>

    <footer>You already ordered <strong>&euro; <?php echo $totalValue ?></strong> in food and drinks.</footer>
</div>

<style>
    footer {
        text-align: center;
    }
</style>
</body>
</html>