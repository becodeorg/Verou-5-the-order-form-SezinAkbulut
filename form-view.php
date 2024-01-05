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

    <style>
        *{
            margin: 0 0;
            padding: 0 0;
            font-family: Arial, Helvetica, sans-serif;
        }
        body{
            background-image: url(./images/eco-friendly-disposable-paper-tableware-copy-space-arrangement.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

        }
        .container{
            width: 100%;
            margin: 0 auto;
            padding: 1%;
        }
        footer {
            text-align: center;
        }

        .logo{
            width: 10%;
            float: left;
        }
        nav{
            line-height: 70px;
            width: 100%;
            background-color: #ececec;
            padding:  0;
            margin-bottom: 2%;
        }
        .nav ul{
            list-style-type: none;

        }

        .nav ul li{
            display: block;
            padding: 1%;
            font-weight: bold;
            float: right;
        }

        a{
            color: #AE7544;
            text-decoration: none;
            font-weight: bold;

        }
        a:hover{
            color: #ff4757;
        }
        .btn{
            padding: 1%;
            border: none;
            font-size: 1rem;
            border-radius: 5px;
        }
        .btn-primary{
            background-color: #ff6b81;
            color: white;
            cursor: pointer;
        }
        .btn-primary:hover{
            color: white;
            background-color: #ff4757;
        }
        .img-responsive{
            width: 100%;
        }
        h1{
            color: #AE7544;
            font-size: 2rem;
            margin-bottom: 2%;
            text-align: center;

        }
        legend{
            font-size: 1.5rem;
            color: #AE7544;
        }
        .form-control{
            width: 96%;
            padding: 1%;
            margin-bottom: 3%;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        .order-label{
            margin-bottom: 1%;
            font-weight: bold;
        }

        #orderForm{
            width: 50%;
            margin: 0 auto;
            border: 1px solid white;
            padding: 3%;
            border-radius: 5px;
        }

    </style>

</head>
<body>
<div class="container">
    <div class="logo">
        <a href="#" title="Logo">
            <img src="./images/logo.png" alt="Restaurant Logo" class="img-responsive">
        </a>
    </div>
    <?php // Navigation for when you need it ?>

    <nav>
        <div class="menu justify-content-end">
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

    <h1>Place your order</h1>

    <fieldset>

    <form action="./index.php" method="POST" id="orderForm">

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

    </fieldset>

</div>

</body>
</html>