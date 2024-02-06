<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the product ID and updated quantity from the AJAX request
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    // Assume your unit price is $10.00 (replace it with your actual unit price)
    $unitPrice = 10.00;

    // Calculate the new amount based on the quantity
    $newAmount = $quantity * $unitPrice;

    // Return the new amount as a JSON response
    echo json_encode(['newAmount' => $newAmount]);
}
?>
