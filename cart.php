<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | Gflow</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <!-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="icon" href="img/g1.png">
</head>

<body class="bg">

    <div class="container">
        <div class="row">
            <?php include "header-page.php";

            if (isset($_SESSION["u"])) {

                $user = $_SESSION["u"]["email"];

                $total = 0;
                $subtotal = 0;
                $shipping = 0;

            ?>
                <hr style="height: 70px;">


                <div class="col-12 pt-2 rounded t" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-light text-decoration-none" href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>

                <hr>

                <!-- <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-10 mb-3">
                            <input type="text" class="form-control" placeholder="Search in Cart Item..." />
                        </div>
                        <div class="col-12 col-lg-2 mb-4 d-grid">
                            <button class="btn btn-warning">Search</button>
                        </div>
                    </div>
                </div> -->

                <div class="col-md-8">
                    <div class="p-3 fs-5  rounded text-center">
                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                        $cart_num = $cart_rs->num_rows;

                        if ($cart_num == 0) {
                        ?>
                            <!-- Empty View -->
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 emptyCart "></div>
                                    <div class="col-12 text-center mb-2 mt-4">
                                        <label class="form-label text-light fs-1 fw-bold">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                        <a href="home.php" class="btn btn-warning fs-3 fw-bold">
                                            Start Shopping
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Empty View -->
                        <?php
                        } else {
                        ?>
                            <div class="col-12">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON
                                        product.id=product_img.product_id    WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                        $address_rs = Database::search("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON
                                    user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                    city.district_district_id=district.district_id WHERE `user_email`='" . $user . "'");



                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;


                                        if (($address_data["did"] == 1)) {
                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $ship;
                                        } else {
                                            $ship = $product_data["delivery_fee_other"];
                                            $shipping = $shipping + $ship;
                                        }


                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $data["fname"] . " " . $data["lname"];

                                    ?>
                                        <div class="card mb-3 mx-0 col-12" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                                            <div class="row g-0">
                                                <!-- <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <span class="fw-bold text-black-50 fs-5">Seller :</span>&nbsp;
                                                            <span class="fw-bold text-black fs-5"><?php echo $seller; ?></span>&nbsp;
                                                        </div>
                                                    </div>
                                                </div> -->

                                                <hr>

                                                <div class="col-md-4">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["title"]; ?>" title="Product Title">
                                                        <img src="<?php echo $product_data["img_path"]; ?>" class="img-fluid rounded-start" style="max-width: 200px;">
                                                    </span>

                                                </div>
                                                <div class="col-md-5">
                                                    <div class="card-body">

                                                        <h3 class="card-title text-light fw-bold"><?php echo $product_data["title"]; ?></h3>



                                                        <!-- <span class="fw-bold text-light fs-5">Colour : <?php echo $product_data["clr_name"]; ?></span> <br> &nbsp; | -->

                                                        &nbsp; <span class="fw-bold text">Condition : <?php echo $product_data["condition_condition_id"]; ?></span>
                                                        <br>
                                                        <span class="fw-bold text-light fs-5">Price :</span>&nbsp;
                                                        <span class="fw-bold text-light fs-5">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                        <br>
                                                        <span class="fw-bold text-light fs-5">Quantity :</span>&nbsp;
                                                        <input type="number" class="mt-2 border border-2 border-secondary fs-4 fw-bold rounded px-3 cardqtytext" style="width: 90px;height: 40px;" value="<?php echo $cart_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>);" id="qty_num">
                                                        <br><br>
                                                        <span class="fw-bold text-light fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-light fs-5">Rs.<?php echo $ship; ?>.00</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="card-body d-grid">
                                                        <!-- <a class="btn btn-warning mb-2" >Buy Now</a> -->
                                                        <a class="btn btn-danger mb-2" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);"><i class="bi bi-trash3"></i></a>
                                                    </div>
                                                </div>

                                                <hr>

                                                <div class="col-md-12 mt-3 mb-3">
                                                    <div class="row">
                                                        <div class="col-6 col-md-6">
                                                            <span class="fw-bold fs-5 text-light">Requested Total <i class="bi bi-info-circle"></i></span>
                                                        </div>
                                                        <div class="col-6 col-md-6 ">
                                                            <span class="fw-bold fs-5 text-light">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="text-dark">
                                            </div>
                                        </div>
                                    <?php

                                    }

                                    ?>



                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class=" p-3 fs-7 row text-light rounded" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">

                        <div class="col-12">
                            <label class="form-label fs-3 fw-bold">Order Summary</label>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-6 mb-1 ">
                            <span class="fs-7 fw-bold">items (<?php echo $cart_num; ?>)</span>
                        </div>

                        <div class="col-6 text-end mb-3">
                            <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                        </div>

                        <div class="col-6">
                            <span class="fs-6 fw-bold">Shipping</span>
                        </div>

                        <div class="col-6 text-end">
                            <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                        </div>

                        <div class="col-12 mt-3">
                            <hr />
                        </div>

                        <div class="col-6 mt-2">
                            <span class="fs-4 fw-bold">Total</span>
                        </div>

                        <div class="col-6 mt-2 text-end">
                            <span class="fs-4 fw-bold" style="margin-left: -50px;">Rs. <?php echo $total + $shipping; ?> .00</span>
                        </div>

                        <div class="col-12 mt-3 mb-3 d-grid">
                            <button class="btn btn-warning fs-5 fw-bold" onclick="checkOut();">CHECKOUT</button>
                        </div>


                    </div>
                </div>

            <?php


            } else {
            ?>
                <div class="col-12 text-center mt-5 mb-5">
                    <i class="bi bi-exclamation-triangle-fill text-danger mb-5" style="font-size: 150px;"></i>
                    <h2 class="text-danger fw-bold">Please Register or Sign In</h2>
                    <span class="text-muted">No matching User wre found for the search text you have entered.</span>
                </div>
            <?php
            }

            ?>
        </div>
    </div>

    <?php include "footer.php"; ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>