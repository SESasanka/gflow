<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Product | Gflow</title>
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">


    <link rel="icon" href="img/g1.png">

</head>

<body class="bg-dark">



    <div class="container">
        <div class="row mt-3">

            <?php
            session_start();
            include "connection.php";

            if (isset($_SESSION["au"]) && isset($_SESSION["p"])) {

                $product = $_SESSION["p"];

            ?>


                <div class="col-12 d-flex justify-content-center align-items-center min-vh-100">
                    <div class="row border rounded-5 p-3 bg-white shadow box-area">

                        <div class="col-lg-12 ">
                            <div class="row ">
                                <div class="col-12 text-center mb-3">
                                    <h2 class="h2 text-warning fw-bold">Update Product</h2>
                                </div>


                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label " style="font-size: 20px;">Add Product Images</label>
                                        </div>
                                        <div class=" col-12 col-lg-12">

                                            <?php

                                            $img = array(); //index arry

                                            $img[0] = "img/addproductimg.svg";

                                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                            $product_img_num = $product_img_rs->num_rows;


                                            $product_img_data = $product_img_rs->fetch_assoc();

                                            $img[0] = $product_img_data["img_path"];


                                            ?>

                                            <div class="row">

                                                <img id="i0" src="<?php echo $img[0]; ?>" class="w-100" />

                                            </div>
                                        </div>
                                        <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3 mb-3">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12 btn btn-warning" onclick="changeProductImage();">Upload Images</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label class="form-label " style="font-size: 20px;">
                                                Product Title
                                            </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input id="t" type="text" class="form-control" value="<?php echo $product["title"]; ?>" />
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 p-2">
                                    <div class="row">

                                        <div class="col-12 col-lg-4">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label " style="font-size: 20px;">Product Category</label>
                                                </div>

                                                <div class="col-12">
                                                    <select class="form-select text-center" disabled>
                                                        <?php
                                                        $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_cat_id"] . "'");
                                                        $category_data = $category_rs->fetch_assoc();
                                                        ?>
                                                        <option><?php echo $category_data["cat_name"]; ?></option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4 ">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label " style="font-size: 20px;">Product Brand</label>
                                                </div>

                                                <div class="col-12">
                                                    <select class="form-select text-center" disabled>
                                                        <?php
                                                        $brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` IN 
                                                    (SELECT `brand_brand_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                                        $brand_data = $brand_rs->fetch_assoc();
                                                        ?>
                                                        <option><?php echo $brand_data["brand_name"]; ?></option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-4 mb-3">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label " style="font-size: 20px;">Product Model</label>
                                                </div>

                                                <div class="col-12">
                                                    <select class="form-select text-center" disabled>
                                                        <?php
                                                        $model_rs = Database::search("SELECT * FROM `model` WHERE `model_id` IN 
                                                    (SELECT `model_model_id` FROM `model_has_brand` WHERE `id`='" . $product["model_has_brand_id"] . "')");
                                                        $model_data = $model_rs->fetch_assoc();
                                                        ?>
                                                        <option><?php echo $model_data["model_name"]; ?></option>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>





                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="form-label " style="font-size: 20px;">Product Condition</label>
                                                        </div>
                                                        <?php
                                                        if ($product["condition_condition_id"] == 1) {
                                                        ?>
                                                            <div class="col-12">
                                                                <div class="form-check form-check-inline mx-5">
                                                                    <input class="form-check-input" type="radio" id="b" name="c" checked disabled />
                                                                    <label class="form-check-label " for="b">Brandnew</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="u" name="c" disabled />
                                                                    <label class="form-check-label " for="u">Used</label>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-12">
                                                                <div class="form-check form-check-inline mx-5">
                                                                    <input class="form-check-input" type="radio" id="b" name="c" disabled />
                                                                    <label class="form-check-label " for="b">Brandnew</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" id="u" name="c" checked disabled />
                                                                    <label class="form-check-label " for="u">Used</label>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>

                                                    </div>
                                                </div>

                                                <!-- <div class="col-12 col-lg-4 border-end border-success">
                                            <div class="row">

                                                <div class="col-12">
                                                    <label class="form-label " style="font-size: 20px;">Product Colour</label>
                                                </div>

                                                <div class="col-12">
                                                    <select class="col-12 form-select" disabled>
                                                        <?php
                                                        $color_rs = Database::search("SELECT * FROM `color` INNER JOIN `product_has_color` ON 
                                                            color.clr_id=product_has_color.color_clr_id WHERE `product_id`='" . $product["id"] . "'");
                                                        $color_num = $color_rs->num_rows;

                                                        for ($x = 0; $x < $color_num; $x++) {
                                                            $color_data = $color_rs->fetch_assoc();

                                                        ?>
                                                            <option >
                                                                <?php echo $color_data["clr_name"]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-12">
                                                    <div class="input-group mt-2 mb-2">
                                                        <input type="text" class="form-control" placeholder="Add new Colour" disabled />
                                                        <button class="btn btn-outline-primary" type="button" id="button-addon2" disabled>+ Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="form-label " style="font-size: 20px;">Product Quantity</label>
                                                        </div>
                                                        <div class="col-12">
                                                            <input type="number" class="form-control" min="0" value="<?php echo $product["qty"]; ?>" id="q" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="border-success" />
                                        </div>

                                        <div class="col-12">
                                            <div class="row">

                                                <div class="col-12 border-success">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label class="form-label " style="font-size: 20px;">Cost Per Item</label>
                                                        </div>
                                                        <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                            <div class="input-group mb-2 mt-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                <input type="text" class="form-control" disabled value="<?php echo $product["price"]; ?>" />
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="border-success" />
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label " style="font-size: 20px;">Delivery Cost</label>
                                                </div>
                                                <div class="col-12 col-lg-6 ">
                                                    <div class="row">
                                                        <div class="col-12 offset-lg-1 col-lg-3">
                                                            <label class="form-label">Delivery cost Within Colombo</label>
                                                        </div>
                                                        <div class="col-12 col-lg-8">
                                                            <div class="input-group mb-2 mt-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                <input type="text" class="form-control" value="<?php echo $product["delivery_fee_colombo"]; ?>" id="dwc" />
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12 offset-lg-1 col-lg-3">
                                                            <label class="form-label">Delivery cost out of Colombo</label>
                                                        </div>
                                                        <div class="col-12 col-lg-8">
                                                            <div class="input-group mb-2 mt-2">
                                                                <span class="input-group-text">Rs.</span>
                                                                <input type="text" class="form-control" value="<?php echo $product["delivery_fee_other"]; ?>" id="doc" />
                                                                <span class="input-group-text">.00</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <hr class="border-success" />
                                        </div>

                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label class="form-label " style="font-size: 20px;">Product Description</label>
                                                </div>
                                                <div class="col-12">
                                                    <textarea cols="30" rows="15" class="form-control" id="d"><?php echo $product["description"]; ?></textarea>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mt-3 mb-3">
                                            <button class="btn btn-warning" onclick="updateProduct();">Update Product</button>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>



                    </div>

                </div>

            <?php
            } else {
            ?>
                <script>
                    alert("Please select a product to Update.");
                    window.location = "myProducts.php";
                </script>
            <?php
            }


            ?>




        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>