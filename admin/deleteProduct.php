<?php
   require("../connection.php");
   if (isset($_GET['product_id'])) {
       $productId = $_GET['product_id'];
       $sql="UPDATE `tbl_product`set  `status`=1 WHERE product_id=$productId";
       if ($conn->query($sql) === TRUE) {
        echo'<script>window.location.href="viewProducts.php";</script>';
       }
   }   
?>