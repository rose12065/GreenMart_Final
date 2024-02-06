<?php
require('../connection.php');
if(isset($_GET['order_id']))
    {
        $orderId=$_GET['order_id'];
        $sql_delivery_status_update = "UPDATE tbl_order SET delivery_status = 1 WHERE order_id =  '$orderId'";
        if ($conn->query($sql_delivery_status_update) === TRUE) {
            echo'<script>window.location.href="acceptOrder.php ? order_id=<?php echo $order_id ?>";</script>';
           }
    }

    ?>