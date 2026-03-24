<?php

include "connection.php";

if (isset($_GET["f"]) && isset($_GET["t"])) {

    $from = $_GET["f"];
    $to = $_GET["t"];

    $invoice_rs = Database::search("SELECT * FROM `invoice`");
    $invoice_num = $invoice_rs->num_rows;

    for ($x = 0; $x < $invoice_num; $x++) {
        $invoice_data = $invoice_rs->fetch_assoc();

        $sold_date = $invoice_data["date"];
        $date = explode(" ", $sold_date);

        $d = $date[0];
        $t = $date[1];

        if (!empty($from) && empty($to)) {
            if ($from <= $d) {

?>
                <table class="table  table-striped">
                    <tbody>
                        <tr>

                            <td class="form-label fs-5 text-light mt-1 mb-1"><?php echo $invoice_data["invoice_id"]; ?></td>


                            <?php

                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();

                            ?>


                            <td class="form-label fs-6 text-light mt-1 mb-1"><?php echo $product_data["title"]; ?></td>


                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                            $user_data = $user_rs->fetch_assoc();
                            ?>


                            <td class="form-label fs-6 text-light  mt-1 mb-1"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>


                            <td class="form-label fs-6  text-light mt-1 mb-1">LKR <?php echo $invoice_data["total"]; ?> .00</td>


                            <td class="form-label text-light fs-6 mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></td>

                            <td class=" d-grid">
                                <?php
                                if ($invoice_data["status"] == 0) {
                                    //order comform 
                                ?>
                                    <button class="btn btn-success  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Order Get Delivery Service</button>
                                <?php
                                } else if ($invoice_data["status"] == 1) {
                                ?>
                                    <button class="btn btn-warning  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Packing</button>
                                <?php
                                } else if ($invoice_data["status"] == 2) {
                                ?>
                                    <button class="btn btn-secondary  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Dispatch</button>
                                <?php
                                } else if ($invoice_data["status"] == 3) {
                                ?>
                                    <button class="btn btn-primary  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Shipping</button>
                                <?php
                                } else if ($invoice_data["status"] == 4) {
                                ?>
                                    <button class="btn btn-danger  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Delivery</button>
                                <?php
                                } else if ($invoice_data["status"] == 6) {
                                ?>
                                    <button class="btn btn-info  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Confirm Order</button>
                                <?php
                                }
                                ?>

                            </td>

                        </tr>
                    </tbody>
                </table>
            <?php

            }
        } else if (empty($from) && !empty($to)) {
            if ($to >= $sold_date) {
            ?>
                <table class="table  table-striped">
                    <tbody>
                        <tr>

                            <td class="form-label fs-5  mt-1 mb-1"><?php echo $invoice_data["invoice_id"]; ?></td>


                            <?php

                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();

                            ?>


                            <td class="form-label fs-6  mt-1 mb-1"><?php echo $product_data["title"]; ?></td>


                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                            $user_data = $user_rs->fetch_assoc();
                            ?>


                            <td class="form-label fs-6   mt-1 mb-1"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>


                            <td class="form-label fs-6   mt-1 mb-1">Rs. <?php echo $invoice_data["total"]; ?> .00</td>


                            <td class="form-label fs-6 mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></td>

                            <td class=" d-grid">
                                <?php
                                if ($invoice_data["status"] == 0) {
                                    //order comform 
                                ?>
                                    <button class="btn btn-success  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Order Get Delivery Service</button>
                                <?php
                                } else if ($invoice_data["status"] == 1) {
                                ?>
                                    <button class="btn btn-warning  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Packing</button>
                                <?php
                                } else if ($invoice_data["status"] == 2) {
                                ?>
                                    <button class="btn btn-secondary  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Dispatch</button>
                                <?php
                                } else if ($invoice_data["status"] == 3) {
                                ?>
                                    <button class="btn btn-primary  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Shipping</button>
                                <?php
                                } else if ($invoice_data["status"] == 4) {
                                ?>
                                    <button class="btn btn-danger  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Delivery</button>
                                <?php
                                } else if ($invoice_data["status"] == 6) {
                                ?>
                                    <button class="btn btn-info  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Confirm Order</button>
                                <?php
                                }
                                ?>

                            </td>

                        </tr>
                    </tbody>
                </table>
            <?php
            }
        } else if (!empty($from) && !empty($to)) {
            if ($from <= $d && $to >= $d) {

            ?>
                <table class="table  table-striped">
                    <tbody>
                        <tr>

                            <td class="form-label fs-5  mt-1 mb-1"><?php echo $invoice_data["invoice_id"]; ?></td>


                            <?php

                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                            $product_data = $product_rs->fetch_assoc();

                            ?>


                            <td class="form-label fs-6  mt-1 mb-1"><?php echo $product_data["title"]; ?></td>


                            <?php
                            $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $invoice_data["user_email"] . "'");
                            $user_data = $user_rs->fetch_assoc();
                            ?>


                            <td class="form-label fs-6   mt-1 mb-1"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>


                            <td class="form-label fs-6   mt-1 mb-1">Rs. <?php echo $invoice_data["total"]; ?> .00</td>


                            <td class="form-label fs-6 mt-1 mb-1"><?php echo $invoice_data["qty"]; ?></td>

                            <td class=" d-grid">
                                <?php
                                if ($invoice_data["status"] == 0) {
                                    //order comform 
                                ?>
                                    <button class="btn btn-success  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Order Get Delivery Service</button>
                                <?php
                                } else if ($invoice_data["status"] == 1) {
                                ?>
                                    <button class="btn btn-warning  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Packing</button>
                                <?php
                                } else if ($invoice_data["status"] == 2) {
                                ?>
                                    <button class="btn btn-secondary  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Dispatch</button>
                                <?php
                                } else if ($invoice_data["status"] == 3) {
                                ?>
                                    <button class="btn btn-primary  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Shipping</button>
                                <?php
                                } else if ($invoice_data["status"] == 4) {
                                ?>
                                    <button class="btn btn-danger  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Delivery</button>
                                <?php
                                } else if ($invoice_data["status"] == 6) {
                                ?>
                                    <button class="btn btn-info  mt-1 mb-1" id="btn<?php echo $invoice_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $invoice_data['invoice_id']; ?>');">Confirm Order</button>
                                <?php
                                }
                                ?>

                            </td>

                        </tr>
                    </tbody>
                </table>
<?php
            }
        }
    }
}

?>