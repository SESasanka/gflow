<?php

include "connection.php";


$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product` ";

if (!empty($txt) && $select == 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%'";
} else if (empty($txt) && $select != 0) {
    $query .= "WHERE `category_cat_id`='" . $select . "'";
} else if (!empty($txt) && $select != 0) {
    $query .= "WHERE `title` LIKE '%" . $txt . "%' AND `category_cat_id`='" . $select . "'";
}

?>



<div class="container-fluid">

    <div class=" col-12 col-lg-12 mt-5">
        <div class="row mt-5">

                <div class="col-12">
                    <div class="row mt-5">
                        <!-- filter -->
                        <div class=" col-10 col-lg-2 mx-3 my-3 text-light" style="background-color: rgba(255, 255, 255, 0.074);
  border: 1px solid rgba(255, 255, 255, 0.222);
  -webkit-backdrop-filter: blur(20px);
  backdrop-filter: blur(20px); border-radius: 10px;">
                            <div class="row">
                                <div class="col-12 mt-4 fs-5">
                                    <div class="row">

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-2">Filter Products</label>
                                        </div>
                                        <div class="col-12 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="text" placeholder="Search..." class="form-control" id="s" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Brand</label>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r0" id="r" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="r">
                                                    ROG
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r0" id="m" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="m">
                                                    MSI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r0" id="a" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="a">
                                                    ASUS
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r0" id="le" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="le">
                                                    LENOVO
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Category</label>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r4" id="lp" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="lp">
                                                    Laptops
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r4" id="cb" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="cb">
                                                    Computer Builds
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r4" id="cp" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="cp">
                                                    Computer Parts
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r4" id="pt" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="pt">
                                                    Paystation
                                                </label>
                                            </div>
                                        </div>

                                        <!-- <div class="col-12">
                                            <label class="form-label fw-bold fs-3">GPU</label>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r5" id="gp1" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="gp1">
                                                    RTX 4090 16GB
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r5" id="gp2" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="gp2">
                                                    RTX 4080 12GB
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r5" id="gp3" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="gp3">
                                                    RTX 4070 8GB
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r5" id="gp4" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="gp4">
                                                    RTX 4060 8GB
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r5" id="gp5" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="gp5">
                                                    RTX 3050 6GB
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-4">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r5" id="gp6" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="gp6">
                                                    RTX 2050 2GB
                                                </label>
                                            </div>
                                        </div> -->

                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-3">Price</label>
                                        </div>
                                        <hr>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r1" id="n" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="n">
                                                    High to Low
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r1" id="o" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="o">
                                                    Low to High
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold fs-3">By Quntity</label>
                                        </div>
                                        <hr>

                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r2" id="h" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="h">
                                                    High to low
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r2" id="l" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="l">
                                                    Low to high
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label class="form-label fw-bold fs-3">By condition</label>
                                        </div>
                                        <hr>

                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r3" id="b" onclick="sort1(0);">
                                                <label class="form-check-label fs-5" for="b">
                                                    Brandnew
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form">
                                                <input class="form-check-input fs-5" type="checkbox" name="r3" id="u">
                                                <label class="form-check-label fs-5" for="u">
                                                    Used
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12 text-center mt-3 mb-3">
                                            <div class="row g-2">
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-warning fw-bold" onclick="sort1(0);">Sort</button>
                                                </div>
                                                <div class="col-12 col-lg-6 d-grid">
                                                    <button class="btn btn-primary fw-bold" onclick="clearSort();">Clear</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- filter -->

                        <!-- product -->

                        <div class="col-12 col-lg-9 mt-3 mb-3 ">
                            <div class="row" id="sort">

                                <div class=" col-12 text-center">
                                    <div class="row justify-content-center">

                                        <?php

                                        if (isset($_GET["page"])) {
                                            $pageno = $_GET["page"];
                                        } else {
                                            $pageno = 1;
                                        }

                                        $product_rs = Database::search($query);
                                        $product_num = $product_rs->num_rows;

                                        $result_per_page = 8;
                                        $number_of_pages = ceil($product_num / $result_per_page); // dashama sankaya thiyed kiyl balala purn sankay vt harwim 

                                        $page_results = ($pageno - 1) * $result_per_page; //inna page eka anuva kothan idan kothatad result pennane
                                        $selected_rs = Database::search($query . " LIMIT " . $result_per_page . " OFFSET " . $page_results . ""); //view karan product tika view kirim

                                        $selected_num = $selected_rs->num_rows;
                                        for ($x = 0; $x < $selected_num; $x++) {
                                            $selected_data = $selected_rs->fetch_assoc();
                                        ?>
                                            <!-- card -->
                                            <div class="card card-design col-6 col-lg-2 mt-2 mb-2" style="width: 18rem;">
                                                <a href='<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>' class="link-dark text-decoration-none">
                                                    <?php
                                                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                                    $img_data = $img_rs->fetch_assoc();
                                                    ?>

                                                    <img src="<?php echo $img_data["img_path"]; ?>" class=" card-img justify-content-center align-items-center" style="height: 250px;" />
                                                    <div class="card-body ms-0 m-0 text-center">
                                                        <h5 class="card-title fw-bold fs-6 link-light text-decoration-none"><?php echo $selected_data["title"]; ?></h5>
                                                        <!-- <span class="badge rounded-pill text-bg-info">New</span><br /> -->
                                                        <span class="fs-3 fw-bold card-text text-warning">LKR <?php echo $selected_data["price"]; ?>.00</span><br />

                                                        <?php

                                                        if ($selected_data["qty"] > 0) {
                                                        ?>
                                                            <div class="ms-4">
                                                                <button class="col-12 btn Btn ms-4" onclick="addToCart(<?php echo $selected_data['id'] ?>);">
                                                                    <div class="sign fs-3">+ </div>
                                                                    <div class="text">Add to</div>
                                                                </button>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>

                                                            <span class="card-text text-danger fw-bold">Out Stock</span><br />
                                                            <!-- <span class="card-text text-danger fw-bold">00 Items Available</span><br /><br /> -->
                                                            <!-- <a href='#' class="col-12 btn btn-warning disabled">Buy Now</a> -->
                                                            <div class="ms-4">
                                                                <button class="col-12 btn Btn bg-danger disabled ms-4">
                                                                    <div class="sign fs-3">+ </div>
                                                                    <div class="text">Add to</div>
                                                                </button>
                                                            </div>
                                                        <?php
                                                        }

                                                        ?>



                                                    </div>
                                                </a>
                                            </div>
                                            <!-- card -->
                                        <?php
                                        }

                                        ?>


                                    </div>
                                </div>

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
                                                    <li class="page-item ">
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

                        <!-- product -->

                    </div>
                </div>
            <?php

            

            ?>





            <?php



            ?>


        </div>
    </div>


    <?php



    ?>

</div>
</div>