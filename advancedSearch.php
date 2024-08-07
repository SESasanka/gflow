<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Advanced Search | Gflow</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <link rel="icon" href="img/g1.png">

</head>

<body class="bg">
    <?php include "header-page.php";

    ?>


    <div class="container-fluid">
        <div class="row mt-5">

            <div class="col-12  col-lg-3 rounded-3 mt-5">




                <div class="col-12  mb-3 " style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                    <div class="row">
                        <div class="offset-lg-4 col-12 col-lg-4">
                            <div class="row">

                                <div class="col-12 text-center">
                                    <P class="fs-2 text-light fw-bold mt-3 pt-3">Advanced Search</P>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12  mb-3 mt-2  rounded" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                    <div class="row">

                        <div class="offset-lg-1 col-12 col-lg-10 mt-2">
                            <div class="row">
                                <div class="col-12 col-lg-9 mt-2 mb-1">
                                    <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                                </div>
                                <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                    <button class="btn btn-warning" onclick="advancedSearch(0);">Search</button>
                                </div>
                                <div class="col-12 ">

                                </div>
                            </div>
                        </div>

                        <div class="offset-lg-1 col-12 col-lg-10 mt-2">
                            <div class="row">

                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-12 col-lg-12 mb-3">
                                            <select class="form-select" id="c1">
                                                <option value="0">Select Category</option>
                                                <?php

                                                $category_rs = Database::search("SELECT * FROM `category`");
                                                $category_num = $category_rs->num_rows;

                                                for ($x = 0; $x < $category_num; $x++) {
                                                    $category_data = $category_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                                        <?php echo $category_data["cat_name"]; ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-12 mb-3">
                                            <select class="form-select" id="b1">
                                                <option value="0">Select Brand</option>
                                                <?php

                                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                                $brand_num = $brand_rs->num_rows;

                                                for ($x = 0; $x < $brand_num; $x++) {
                                                    $brand_data = $brand_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $brand_data["brand_id"]; ?>">
                                                        <?php echo $brand_data["brand_name"]; ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-12 mb-3">
                                            <select class="form-select" id="m">
                                                <option value="0">Select Model</option>
                                                <?php

                                                $model_rs = Database::search("SELECT * FROM `model`");
                                                $model_num = $model_rs->num_rows;

                                                for ($x = 0; $x < $model_num; $x++) {
                                                    $model_data = $model_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $model_data["model_id"]; ?>">
                                                        <?php echo $model_data["model_name"]; ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-12 mb-3">
                                            <select class="form-select" id="c2">
                                                <option value="0">Select Condition</option>
                                                <?php

                                                $condition_rs = Database::search("SELECT * FROM `condition`");
                                                $condition_num = $condition_rs->num_rows;

                                                for ($x = 0; $x < $condition_num; $x++) {
                                                    $condition_data = $condition_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $condition_data["condition_id"]; ?>">
                                                        <?php echo $condition_data["condition_name"]; ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-12 mb-3">
                                            <select class="form-select" id="c3">
                                                <option value="0">Select Colour</option>
                                                <?php

                                                $color_rs = Database::search("SELECT * FROM `color`");
                                                $color_num = $color_rs->num_rows;

                                                for ($x = 0; $x < $color_num; $x++) {
                                                    $color_data = $color_rs->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $color_data["clr_id"]; ?>">
                                                        <?php echo $color_data["clr_name"]; ?></option>
                                                <?php
                                                }

                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                        </div>

                                        <div class="col-12 col-lg-6 mb-3">
                                            <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12 rounded mb-3" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                    <div class="row">
                        <div class="offset-3 col-6 mt-2 mb-2">
                            <select id="s" class="form-select">
                                <option value="0">SORT BY</option>
                                <option value="1">PRICE LOW TO HIGH</option>
                                <option value="2">PRICE HIGH TO LOW</option>
                                <option value="3">QUANTITY LOW TO HIGH</option>
                                <option value="4">QUANTITY HIGH TO LOW</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 offset-1 col-md-8 offset-md-0 col-lg-9">
                <div class="row">
                    <div class="col-12 col-lg-12 mt-5 text-center">
                        <div class="row " id="view_area">
                            <div class="col-12 mt-5">
                                <span class="fw-bold text-danger"><i class="bi bi-search h1" style="font-size: 100px;"></i></span>
                            </div>
                            <div class="offset-3 col-6 mt-3 mb-5">
                                <span class="h1 text-danger fw-bold">No Items Searched Yet...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <?php include "footer.php"; ?>
    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>