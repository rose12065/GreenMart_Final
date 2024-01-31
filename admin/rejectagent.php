<?php
   require("../connection.php");
   if (isset($_GET['agent_id'])) {
       $agentId = $_GET['agent_id'];
       $sql="UPDATE tbl_delivery_register SET status = 2 WHERE delivery_id=$agentId";
       echo $sql;
       if ($conn->query($sql) === TRUE) {
        echo'<script>window.location.href="delivery.php";</script>';
       }
      
   }   
?>
