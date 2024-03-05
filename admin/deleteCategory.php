<?php
   require("../connection.php");
   if (isset($_GET['category_id'])) {
       $categoryId = $_GET['category_id'];
       $deleteRecommendationsQuery = "DELETE FROM tbl_pdt_recommendation WHERE product_id IN (SELECT product_id FROM tbl_product WHERE category_id = $categoryId)";
    if ($conn->query($deleteRecommendationsQuery) === TRUE) {
       $deleteProductsQuery = "DELETE FROM tbl_product WHERE category_id = $categoryId";
    if ($conn->query($deleteProductsQuery) === TRUE) {
        $deleteCategoryQuery = "DELETE FROM tbl_category WHERE category_id = $categoryId";
        if ($conn->query($deleteCategoryQuery) === TRUE) {
           echo" alert('Category and associated products deleted successfully')
           
           <script>window.location.href='viewCategory.php';</script>";


        } else {
            echo "Error deleting category: " . $conn->error;
        }
    } else {
        echo "Error deleting products: " . $conn->error;
    }
   }  
} 
?>
