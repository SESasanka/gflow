<table class="table table-striped">
    <thead>
        <tr>
            <td>ID</td>
            <td>Order ID</td>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Date Time</td>
            <td>Email</td>
            <td>QTY</td>
        </tr>
    </thead>

    <tbody>

        <?php

        include "connection.php";

        $query = "SELECT * FROM `invoice` INNER JOIN `user` ON `invoice`.`user_email`=`user`.`email`";
        $pageno;

        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        } else {
            $pageno = 1;
        }

        $user_rs = Database::search($query);
        $user_num = $user_rs->num_rows;

        $results_per_page = 5;
        $number_of_pages = ceil($user_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

        $selected_num = $selected_rs->num_rows;

        for ($x = 0; $x < $selected_num; $x++) {
            $selected_data = $selected_rs->fetch_assoc();

        ?>

            <tr>
                <td><?php echo ($selected_data["product_id"]); ?></td>
                <td><?php echo ($selected_data["order_id"]); ?></td>
                <td><?php echo ($selected_data["fname"]); ?></td>
                <td><?php echo ($selected_data["lname"]); ?></td>
                <td><?php echo ($selected_data["date"]); ?></td>
                <td><?php echo ($selected_data["user_email"]); ?></td>
                <td><?php echo ($selected_data["qty"]); ?></td>
               
            </tr>

        <?php

        }

        ?>
    </tbody>
</table>

<nav aria-label="mt-3">
    <ul class="pagination  justify-content-center">

        <li class="page-item">
            <a class="page-link" aria-label="Previous" <?php if ($pageno > 1) { ?> onclick="loadCustomer(<?php echo ($pageno - 1) ?>);" <?php }  ?>>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php
        for ($i = 1; $i <= $number_of_pages; $i++) {
            if ($i == $pageno) {
        ?>
                <li class="page-item active"><a class="page-link" onclick="loadCustomer(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
            <?php
            } else {
            ?>
                <li class="page-item"><a class="page-link" onclick="loadCustomer(<?php echo ($i); ?>)"><?php echo ($i); ?></a></li>
        <?php
            }
        }
        ?>


        <li class="page-item">
            <a class="page-link" aria-label="Next" <?php if ($pageno < $number_of_pages) { ?> onclick="loadCustomer(<?php echo ($pageno + 1) ?>);" <?php }  ?>>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>