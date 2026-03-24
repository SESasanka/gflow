<?php

session_start();
if (isset($_SESSION["au"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Admin Panel | Gflow</title>

        <!--font awesome-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
        <link rel="stylesheet" href="bootstrap.css" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

        <link rel="icon" href="img/g1.png">
        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> -->
        <!--css file-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <!-- <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet"> -->

        <link rel="stylesheet" href="styles1.css" />
    </head>

    <body onload="startTime()" class="bg-dark">



        <?php include "adminHeader.php"; ?>


        <section class="content">


            <main>
                <div class="container-fluid">
                    <div class="head-title">
                        <!-- <div class="left">
                            <h1>Dashboard</h1>
                            <ul class="breadcrumb  mt-4">
                                <li>
                                    <a class="fs-5 text-light link-light text-decoration-none" href="#">Dashboard</a>
                                </li>
                                <i class='bx bx-chevron-right text-light fs-2'></i>
                                <li>
                                    <a href="home.php" class="fs-5 active text-light link-light text-decoration-none">Home</a>
                                </li>
                            </ul>
                        </div> -->

                        <div class="col-12 mt-5">
                            <div class="row mt-5">
                                <!-- <div class="col-12 col-lg-2 text-center my-3">
                <label style="color: #F1C40F; font-weight: bold; font-size: 20px; justify-content: center;" class="form-label fs-4 fw-bold ">Total Active Time</label>
              </div> -->
                                <div style="color: #F1C40F; font-weight: bold; font-size: 20px;" class="col-12 mt-5 col-lg-12 text-center my-3 ">

                                    <?php
                                    $start_date = new DateTime("2023-12-15 19:00:00"); //date time object

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);
                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                    $difference = $end_date->diff($start_date);


                                    ?>

                                    <!-- <label class="form-label fs-4 fw-bold text-warning">
                  <?php
                    echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                        $difference->format('%d') . " Days " .  $difference->format('%H') . " Hours " .
                        $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                    ?>

                </label> -->

                                    <div id="clockdate">
                                        <div class="clockdate-wrapper">
                                            <label style="color: #F1C40F; font-weight: bold; font-size: 20px; justify-content: center;" class="form-label fs-4 fw-bold ">Total Active Time</label>

                                            <div id="clock"></div>
                                            <div id="date"></div><br>
                                            <?php
                                            echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " . $difference->format('%d') . " Days ";
                                            // $difference->format('%H') . " Hours " ;
                                            // $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds ";
                                            ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-info">
                    <li>
                        <i class="fas fa-calendar-check"></i>
                        <span class="text">
                            <h3>Daily Earnings</h3>
                            <?php
                            $today = date("Y-m-d");
                            $thismonth = date("m");
                            $thisyear = date("Y");

                            $a = "0";
                            $b = "0";
                            $c = "0";
                            $d = "0";
                            $e = "0";
                            $f = "0";

                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                            $invoice_num = $invoice_rs->num_rows;

                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();

                                $f = $f + $invoice_data["qty"]; //total qty

                                $d = $invoice_data["date"];
                                $splitDate = explode(" ", $d); //index array 
                                $pdate = $splitDate["0"];

                                if ($pdate == $today) {
                                    $a = $a + $invoice_data["total"];
                                    $c = $c + $invoice_data["qty"];
                                }

                                $splitMonth = explode("-", $pdate); //separate date as year,month & day
                                $pyear = $splitMonth["0"]; //year
                                $pmonth = $splitMonth["1"]; //month

                                if ($pyear == $thisyear) {
                                    if ($pmonth == $thismonth) {
                                        $b = $b + $invoice_data["total"];
                                        $e = $e + $invoice_data["qty"];
                                    }
                                }
                            }

                            ?>
                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                        </span>
                    </li>
                    <li>
                        <i class="fas fa-people-group"></i>
                        <span class="text">
                            <h3>Customers</h3>
                            <?php
                            $user_rs = Database::search("SELECT * FROM `user`");
                            $user_num = $user_rs->num_rows;
                            ?>
                            <span class="fs-5"><?php echo $user_num; ?> Members</span>
                        </span>
                    </li>
                    <li>
                        <i class="fas fa-dollar-sign"></i>
                        <span class="text">
                            <h3>Today Sellings</h3>
                            <span class="fs-5"><?php echo $c; ?> Items</span>
                        </span>
                    </li>
                </div>

                <div class="box-info">
                    <li>
                        <i class="fas fa-calendar-check"></i>
                        <span class="text">
                            <h3>Monthly Earnings</h3>
                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                        </span>
                    </li>
                    <li>
                        <i class="fas fa-people-group"></i>
                        <span class="text">
                            <h3>Monthly Sellings</h3>
                            <span class="fs-5"><?php echo $e; ?> Items</span>
                        </span>
                    </li>
                    <li>
                        <i class="fas fa-dollar-sign"></i>
                        <span class="text">
                            <h3>Total Sellings</h3>
                            <span class="fs-5"><?php echo $f; ?> Items</span>
                        </span>
                    </li>
                </div>

                <div class="table-data">
                    <div class="order">
                        <div class="head">
                            <h3>Recent Orders</h3>
                            <i class="fas fa-search"></i>
                            <i class="fas fa-filter"></i>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS`value_occurence` FROM `invoice`
                WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC "); //ad dws thul wadiyen sell una product eka arn denv

                                $freq_num = $freq_rs->num_rows;

                                for ($x = 0; $x < $freq_num; $x++) {

                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                  product.id=product_img.product_id INNER JOIN `user` ON product.user_email=user.email
                  INNER JOIN `profile_img` ON user.email=profile_img.user_email WHERE `id`='" . $freq_data["product_id"] . "'");

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "'
                  AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                    $produc_data = $product_rs->fetch_assoc();
                                ?>
                                    <tr>
                                        <td>

                                            <?php
                                            $seller_rs = Database::search("SELECT * FROM `invoice` INNER JOIN `user` ON
                  invoice.user_email=user.email WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                            $seller_data = $seller_rs->fetch_assoc();

                                            $seller_img = Database::search("SELECT * FROM `user` INNER JOIN `profile_img` ON 
                  user.email=profile_img.user_email WHERE `user_email`='" . $seller_data["email"] . "'");
                                            $seller_img_data = $seller_img->fetch_assoc();
                                            ?>

                                            <img src="<?php echo $seller_img_data["path"]; ?>" alt="" />
                                            <p><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></p>
                                        </td>
                                        <td><?php echo $seller_data["date"]; ?></td>
                                        <td><span class="status pending"><?php echo $seller_data["email"]; ?></span></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>

                    <div class="todo">
                        <div class="head">
                            <h3>Mostly Sold Products</h3>
                            <i class="fas fa-plus"></i>
                            <i class="fas fa-filter"></i>
                        </div>

                        <ul class="todo-list">

                            <?php

                            $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS`value_occurence` FROM `invoice`
              WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC "); //ad dws thul wadiyen sell una product eka arn denv

                            $freq_num = $freq_rs->num_rows;

                            for ($x = 0; $x < $freq_num; $x++) {

                                $freq_data = $freq_rs->fetch_assoc();

                                $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                product.id=product_img.product_id INNER JOIN `user` ON product.user_email=user.email
                INNER JOIN `profile_img` ON user.email=profile_img.user_email WHERE `id`='" . $freq_data["product_id"] . "'");

                                $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "'
                AND `date` LIKE '%" . $today . "%'");
                                $qty_data = $qty_rs->fetch_assoc();

                                $produc_data = $product_rs->fetch_assoc();

                            ?>
                                <li class="not-completed">
                                    <img src="<?php echo $produc_data["img_path"]; ?>" class="img-fluid rounded-top" style="height: 50px;" />
                                    <span class="col-4"><?php echo $produc_data["title"]; ?></span><br />
                                    <span class="col- "><?php echo $qty_data["qty_total"]; ?> items </span><br />
                                    <span class="col- ">LKR <?php echo $qty_data["qty_total"] * $produc_data["price"]; ?> .00</span>

                                </li>
                                <?php

                                ?>

                            <?php

                            }

                            ?>


                        </ul>
                    </div>



                </div>
            </main>
        </section>

        <!-- <div>
                <canvas id="myChart"></canvas>
            </div> -->

        </div>
        <div class="col-12 text-center mt-5">
            <div class="col-12 d-none d-lg-block">
                <p style="color: white;" class="text-center">&copy; 2023 Gflow.lk || All Rights Reserved</p>
            </div>
        </div>
        <script src="app.js"></script>

    </body>

    </html>
<?php
} else {
?>
    <div class="col-12 text-center mt-5 mb-5">
        <i class="bi bi-exclamation-triangle-fill text-danger mb-5" style="font-size: 150px;"></i>
        <h2 class="text-danger fw-bold">You are not a valid user.</h2>
        <!-- <span class="text-muted">No matching User wre found for the search text you have entered.</span> -->
    </div>
<?php
    // echo ("You are not a valid user.");
}



?>