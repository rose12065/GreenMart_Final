<?php
include('connection.php');
include('usernav.php');

// Get the product ID from the URL parameter
if(isset($_GET['product_id'])){
    $productId = $_GET['product_id'];
    $userId = $_SESSION['id'];

    // Fetch the details of the current product
    $productSql = "SELECT * FROM tbl_product WHERE product_id = $productId";
    $productResult = $conn->query($productSql);

    // Fetch additional products related to the current product
    if ($productRow = mysqli_fetch_assoc($productResult)) {
        $productName = $productRow['product_name'];
        // Extract keywords from the product name
        $keywords = explode(' ', $productName);
        $whereClause = '';
        foreach ($keywords as $keyword) {
            // Build WHERE clause to match products with similar names
            $whereClause .= "product_name LIKE '%$keyword%' OR ";
        }
        $whereClause = rtrim($whereClause, 'OR ');

        // Fetch additional products excluding the current product
        $additionalProductsSql = "SELECT * FROM tbl_product WHERE $whereClause AND product_id != $productId LIMIT 4";
        $additionalProductsResult = $conn->query($additionalProductsSql);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS styles */
        /* Add your custom styles here */
    </style>
</head>
<body>

<div class="container py-5">
    <!-- Display current product details -->
    <?php if ($productRow): ?>
        <div class="row">
            <div class="col-md-6">
                <!-- Display product image -->
                <img src="data:image/jpeg;base64,<?php echo base64_encode($productRow['product_image']); ?>" class="img-fluid" alt="Product Image">
            </div>
            <div class="col-md-6">
                <!-- Display product details -->
                <h1 class="mb-4"><?php echo $productRow['product_name']; ?></h1>
                <p class="lead"><?php echo $productRow['product_discription']; ?></p>
                <p class="fw-bold">&#8377; <?php echo $productRow['unit_price']; ?></p>
                <!-- Add to cart form -->
                <form action="" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1">
                    </div>
                    <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Display additional products -->
    <?php if ($additionalProductsResult->num_rows > 0): ?>
        <div class="row mt-5">
            <h2 class="mb-4">Related Products</h2>
            <?php while ($additionalProductRow = $additionalProductsResult->fetch_assoc()): ?>
                <div class="col-md-3">
                    <div class="card">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($additionalProductRow['product_image']); ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $additionalProductRow['product_name']; ?></h5>
                            <p class="card-text">&#8377; <?php echo $additionalProductRow['unit_price']; ?></p>
                            <a href="product_details.php?product_id=<?php echo $additionalProductRow['product_id']; ?>" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
