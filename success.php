<?php
require('connection.php');
require('usernav.php');

// Fetch the user ID from the session
$id = $_SESSION['id'];

// Generate a common order ID for all products in the cart
$commonOrderId = generateRandomId(7);
$date = date('Y-m-d H:i:s');

$fetch_price="SELECT * FROM tbl_price"; 
$all_price=$conn->query($fetch_price);
while($row=mysqli_fetch_assoc($all_price)){
    $priceId=$row['price_id'];
}
// Fetch cart items
$fetch_cart = "SELECT tbl_product.*, tbl_cart_items.quantity FROM tbl_cart_items 
              JOIN tbl_product ON tbl_cart_items.product_id = tbl_product.product_id
              WHERE tbl_cart_items.user_id = $id";
$all_cart = $conn->query($fetch_cart);

// Iterate through cart items
while ($row = mysqli_fetch_assoc($all_cart)) {
    $productId = $row['product_id'];
    $quantity = $row['quantity'];
    $unitPrice = $row['unit_price'];
    $total = $quantity * $unitPrice;

    // Insert order details into tbl_order
    $order_query = "INSERT INTO tbl_order(order_id, user_id, product_id,price_id, quantity, unit_price ,order_date,delivery_status)
                    VALUES ('$commonOrderId', '$id', '$productId','$priceId', '$quantity', '$unitPrice', '$date','Ordered')";
    
    if ($conn->query($order_query)) {
        // Remove the product from the cart
        $remove_cart = "DELETE FROM tbl_cart_items WHERE user_id = $id AND product_id = $productId";
        $conn->query($remove_cart);
    }
}

function generateRandomId($length = 8) {
    $uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $shuffledLetters = str_shuffle($uppercaseLetters);
    $randomUppercase = substr($shuffledLetters, 0, 3);
    $randomNumbers = '';
    
    for ($i = 0; $i < $length - 3; $i++) {
        $randomNumbers .= mt_rand(0, 9); // Append a random number (0-9)
    }

    $randomId = $randomUppercase . $randomNumbers;
    return $randomId;
}
?>
<!-- Add your HTML and styling here -->

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (jQuery and Popper.js are required) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

<div class="container mt-5">
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Payment Successful!</h4>
        <p>Your order has been successfully processed.</p>
        <hr>
        <!-- <p class="mb-0">Click the button below to download your bill as a PDF.</p> -->
    </div>
    <!-- <button class="btn btn-primary" id="downloadPdfBtn">Download PDF</button> -->
</div>
