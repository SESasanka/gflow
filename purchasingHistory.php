<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Purchasing History | Gflow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css" />
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- or -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

    <link rel="icon" href="img/g1.png">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


    <link rel="icon" href="img/g1.png">
</head>

<body class="bg">

    <div class="container">
        <div class="row mt-5">

            <?php include "header-page.php";


            if (isset($_SESSION["u"])) {
                $mail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "'");
                $invoice_num = $invoice_rs->num_rows;

            ?>

                <div class="col-12 text-center mb-3 mt-5">
                    <span class="fs-1 fw-bold text-warning mt-5">Purchasing History</span>
                </div>

                <?php

                if ($invoice_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-12 text-center bg-body" style="height: 450px;">
                        <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
                            You have not purchased any item yet...
                        </span>
                    </div>
                    <!-- empty view -->
                <?php
                } else {
                ?>
                    <!-- Have Product -->
                    <!-- <div class="col-12 mt-3 card justify-content-center text-light rounded" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                        <div class="row">

                            <div class="col-12 d-none d-lg-block justify-content-center  mt-2 rounded-1">
                                <div class="row">
                                    <div class="col-1 ">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3 ">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1  text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2  text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2  text-end">
                                        <label class="form-label fw-bold">Purchased Date & Time</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                    <?php

                    for ($x = 0; $x < $invoice_num; $x++) {
                        $invoice_data = $invoice_rs->fetch_assoc();

                    ?>
                        <div class="col-12 mt-3 text-light card" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                            <div class="row">

                                <div class="col-12 col-lg-1 text-center text-lg-start">
                                    <label class="form-label text-white fs-6 py-5"><?php echo $invoice_data["invoice_id"]; ?></label>
                                </div>
                                <div class="col-12 col-lg-4">
                                    <div class="row">
                                        <div class=" mx-0 mx-lg-3 my-3" style="max-width: 540px;">
                                            <div class="row g-0">
                                                <div class="col-md-4">

                                                    <?php

                                                    $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                                        product.id=product_img.product_id INNER JOIN `user` ON product.user_email=user.email 
                                                        WHERE `id`='" . $invoice_data["product_id"] . "'");

                                                    $product_data = $details_rs->fetch_assoc();

                                                    ?>

                                                    <img src="<?php echo $product_data["img_path"]; ?>" class="w-100 mt-3" />
                                                </div>
                                                <div class="col-md-8 text-lg-end">
                                                    <div class="card-body">

                                                        <h5 class="card-title text-warning"><?php echo $product_data["title"]; ?></h5>
                                                        <p class="card-text"><b>Seller : </b>
                                                            <?php echo $data["fname"] . " " . $data["lname"]; ?>
                                                        </p>
                                                        <p class="card-text "><b>Price : </b>LKR <?php echo $product_data["price"]; ?> .00</p>
                                                        <!-- <span class="badge rounded-pill text-bg-warning">Waiting to accept</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-1 text-center text-lg-end">
                                    <label class="form-label fs-4 py-5"> <?php echo $invoice_data["qty"]; ?></label>
                                </div>
                                <div class="col-12 col-lg-2 text-center text-lg-end ">
                                    <label class="form-label fs-5 py-5 text-white">LKR <?php echo $invoice_data["total"]; ?> .00</label>
                                </div>
                                <div class="col-12 col-lg-2 text-center text-lg-end">
                                    <label class="form-label fs-5 px-3 py-5"><?php echo $invoice_data["date"]; ?></label>
                                </div>
                                <div class="col-12 col-lg-2">
                                    <div class="row">
                                        <div class="col-6 d-lg-grid">
                                            <button class="btn btn-secondary rounded mb-3  mt-5 fs-5" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                                 Feedback
                                            </button>
                                      
                                       
                                            <button class="btn btn-danger rounded  fs-5" onclick="deleteFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                                <i class="bi bi-trash3-fill fs-5"></i> Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php

                    }

                    ?>

                    <div class="col-12">
                        <hr />
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row">
                            <div class="offset-lg-4 col-12 col-lg-4 justify-content-center d-grid">
                                <button class="btn btn-danger rounded mt-5 fs-5" onclick="deleteAllFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                    <i class="bi bi-trash3-fill fs-5"></i> Delete All Records
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- model -->
                    <div class="modal" tabindex="-1" id="feedbackmodal<?php echo $invoice_data['product_id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Add New Feedback</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold">Type</label>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type1" />
                                                            <label class="form-check-label text-success fw-bold" for="type1">
                                                                Positive
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                                            <label class="form-check-label text-warning fw-bold" for="type2">
                                                                Neutral
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type3" />
                                                            <label class="form-check-label text-danger fw-bold" for="type3">
                                                                Negative
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold">User's Email</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <input type="text" class="form-control" disabled id="mail" value="<?php echo $mail; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <label class="form-label fw-bold">Feedback</label>
                                                    </div>
                                                    <div class="col-9">
                                                        <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-outline-primary" onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);">Save Feedback</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- model -->

        </div>
    </div>
    <!-- Have Product -->
<?php
                }
            } else {
?>
<div class="col-12 text-center mt-5 mb-5">
    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 150px;"></i>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>