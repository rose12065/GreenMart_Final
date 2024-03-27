<?php
require("connection.php");
if (isset($_GET['order_id'])) {
    $orderId = $_GET['order_id'];

$id = $_SESSION['id'];
$sql = "UPDATE tbl_order SET status = 1 , delivery_status='cancel' WHERE order_id = '$orderId'";
  if ($conn->query($sql) === TRUE) {
    // Item deleted successfully
    header('Location: cancelation.php'); // Redirect back to the cart page
  } else {
    // Handle the error
    echo "Error deleting item: " . $conn->error;
  }

}
?>