<?php

include "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Selling History | Gflow </title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="img/g1.png" />
</head>

<body class="bg-dark">
    
    <div class="container">
        <div class="row mt-5" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
            <div class="col-12  text-center">
                <label class="form-label text-warning fw-bold fs-1">Order History</label>
            </div>

            <div class="col-12 text-light mt-3 mb-3">
                <div class="row">
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-6">Search by Invoice ID : </label>
                        <input type="text" class="form-control fs-6" id="searchtxt" onkeyup="searchInvoice();" />
                    </div>

                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-6">From Date : </label>
                        <input type="date" class="form-control fs-6" id="from" />
                    </div>
                    <div class="col-12 col-lg-3 mt-3 mb-3">
                        <label class="form-label fs-6">To Date : </label>
                        <input type="date" class="form-control fs-6" id="to" />
                    </div>
                    <div class="col-12 col-lg-3 mt-4 mb-3">
                        <button class="btn btn-warning fs-6 mt-4 " onclick="findsellings();">Find</button>

                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr class="text-light">
                                <!-- <th>ID</th> -->
                                <th>Invoice ID</th>
                                <th>Product</th>
                                <th>Buyer</th>
                                <th>Amount</th>
                                <th>Quantity</th>
                                <th>Order Conform</th>
                            </tr>
                            <!-- <div class="col-12">
                        <div class="row">
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fs-5 fw-bold text-white">Invoice ID</label>
                            </div>
                            <div class="col-3 bg-body text-end">
                                <label class="form-label fs-5 fw-bold text-black">Product</label>
                            </div>
                            <div class="col-3 bg-secondary text-end">
                                <label class="form-label fs-5 fw-bold text-white">Buyer</label>
                            </div>
                            <div class="col-2 bg-body text-end">
                                <label class="form-label fs-5 fw-bold text-black">Amount</label>
                            </div>
                            <div class="col-1 bg-secondary text-end">
                                <label class="form-label fs-5 fw-bold text-white">Quantity</label>
                            </div>
                            <div class="col-2 bg-white"></div>

                        </div>
                    </div> -->
                        </thead>
                        <tbody>
                            <div class="col-12 mt-2" id="viewArea">

                                <?php
                                $query = "SELECT * FROM `invoice`";
                                $pageno;

                                if (isset($_GET["page"])) {
                                    $pageno = $_GET["page"];
                                } else {
                                    $pageno = 1;
                                }

                                $invoice_rs = Database::search($query);
                                $invoice_num = $invoice_rs->num_rows;

                                $results_per_page = 8;
                                $number_of_pages = ceil($invoice_num / $results_per_page);

                                $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
                                $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                                $selected_num = $selected_rs->num_rows;

                                for ($x = 0; $x < $selected_num; $x++) {
                                    $selected_data = $selected_rs->fetch_assoc();

                                ?>

                                    <tr>

                                        <td class="form-label fs-5 text-light mt-1 mb-1"><?php echo $selected_data["invoice_id"]; ?></td>


                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        ?>


                                        <td class="form-label fs-6 text-light mt-1 mb-1"><?php echo $product_data["title"]; ?></td>


                                        <?php
                                        $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                        $user_data = $user_rs->fetch_assoc();
                                        ?>


                                        <td class="form-label fs-6 text-light  mt-1 mb-1"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>


                                        <td class="form-label fs-6 text-light  mt-1 mb-1">Rs. <?php echo $selected_data["total"]; ?> .00</td>


                                        <td class="form-label text-light fs-6 mt-1 mb-1"><?php echo $selected_data["qty"]; ?></td>

                                        <td class=" d-grid">
                                            <?php
                                            if ($selected_data["status"] == 0) {
                                                //order comform 
                                            ?>
                                                <button class="btn btn-success  mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Order Get Delivery Service</button>
                                            <?php
                                            } else if ($selected_data["status"] == 1) {
                                            ?>
                                                <button class="btn btn-warning  mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Packing</button>
                                            <?php
                                            } else if ($selected_data["status"] == 2) {
                                            ?>
                                                <button class="btn btn-secondary  mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Dispatch</button>
                                            <?php
                                            } else if ($selected_data["status"] == 3) {
                                            ?>
                                                <button class="btn btn-primary  mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Shipping</button>
                                            <?php
                                            } else if ($selected_data["status"] == 4) {
                                            ?>
                                                <button class="btn btn-danger  mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Delivery</button>
                                            <?php
                                            } else if ($selected_data["status"] == 6) {
                                            ?>
                                                <button class="btn btn-info  mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Confirm Order</button>
                                            <?php
                                            }
                                            ?>

                                        </td>

                                    </tr>
                                <?php

                                }
                                ?>
                        </tbody>
                    </table>
                </div>

                <!--  -->
                <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination pagination-md justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="
                            <?php if ($pageno <= 1) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno - 1);
                            } ?>
                            " aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                if ($x == $pageno) {
                            ?>
                                    <li class="page-item active">
                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                    </li>
                                <?php
                                } else {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                    </li>
                            <?php
                                }
                            }
                            ?>

                            <li class="page-item">
                                <a class="page-link" href="
                            <?php if ($pageno >= $number_of_pages) {
                                echo ("#");
                            } else {
                                echo "?page=" . ($pageno + 1);
                            } ?>
                            " aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>