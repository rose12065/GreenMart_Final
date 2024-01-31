<?php

    include('connection.php');
    include('usernav.php');
    if(isset($_GET['cat_id'])){
        $cat_id=$_GET['cat_id'];
        $id=$_SESSION['id'];
        $sql = "SELECT * FROM tbl_product where category_id=$cat_id";
        $all_product=$conn->query($sql);
    }
    
    
    /*$find_user = mysqli_query($conn,$query);
    $result = mysqli_fetch_all($find_user,MYSQLI_ASSOC);
  if(count($result) > 0) {
      $name= $result[0]['product_name']; // Access name from $result array
      $price= $result[0]['unit_price'];
      $description = $result[0]['product_discription'];
      $image= $result[0]['product_image'];
      

  }*/
?>
<style>
  hr {
  border: none; /* Remove the default border */
  height: 2px; /* Set the height */
  background-color: #333; /* Set the background color */
  width: 80%; /* Set the width (you can adjust this to your desired width) */
  margin: 20px auto; /* Center it horizontally and add some margin */
}
.form-group {
        display: flex; /* Make label and input elements inline */
        align-items: center; /* Vertically center them */
    }

    .form-group label {
        margin-right: 10px; /* Add some spacing between label and input */
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>masala</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  
  <link rel="stylesheet" type="text/css" href="css/vendor.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <defs>
        <symbol xmlns="http://www.w3.org/2000/svg" id="link" viewBox="0 0 24 24">
          <path fill="currentColor" d="M12 19a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0-4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm-5 0a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm7-12h-1V2a1 1 0 0 0-2 0v1H8V2a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-9h16Zm0-11H4V6a1 1 0 0 1 1-1h1v1a1 1 0 0 0 2 0V5h8v1a1 1 0 0 0 2 0V5h1a1 1 0 0 1 1 1ZM7 15a1 1 0 1 0-1-1a1 1 0 0 0 1 1Zm0 4a1 1 0 1 0-1-1a1 1 0 0 0 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="arrow-right" viewBox="0 0 24 24">
          <path fill="currentColor" d="M17.92 11.62a1 1 0 0 0-.21-.33l-5-5a1 1 0 0 0-1.42 1.42l3.3 3.29H7a1 1 0 0 0 0 2h7.59l-3.3 3.29a1 1 0 0 0 0 1.42a1 1 0 0 0 1.42 0l5-5a1 1 0 0 0 .21-.33a1 1 0 0 0 0-.76Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="category" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 5.5h-6.28l-.32-1a3 3 0 0 0-2.84-2H5a3 3 0 0 0-3 3v13a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3v-10a3 3 0 0 0-3-3Zm1 13a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-13a1 1 0 0 1 1-1h4.56a1 1 0 0 1 .95.68l.54 1.64a1 1 0 0 0 .95.68h7a1 1 0 0 1 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="calendar" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 4h-2V3a1 1 0 0 0-2 0v1H9V3a1 1 0 0 0-2 0v1H5a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3Zm1 15a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-7h16Zm0-9H4V7a1 1 0 0 1 1-1h2v1a1 1 0 0 0 2 0V6h6v1a1 1 0 0 0 2 0V6h2a1 1 0 0 1 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="heart" viewBox="0 0 24 24">
          <path fill="currentColor" d="M20.16 4.61A6.27 6.27 0 0 0 12 4a6.27 6.27 0 0 0-8.16 9.48l7.45 7.45a1 1 0 0 0 1.42 0l7.45-7.45a6.27 6.27 0 0 0 0-8.87Zm-1.41 7.46L12 18.81l-6.75-6.74a4.28 4.28 0 0 1 3-7.3a4.25 4.25 0 0 1 3 1.25a1 1 0 0 0 1.42 0a4.27 4.27 0 0 1 6 6.05Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="plus" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 11h-6V5a1 1 0 0 0-2 0v6H5a1 1 0 0 0 0 2h6v6a1 1 0 0 0 2 0v-6h6a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="minus" viewBox="0 0 24 24">
          <path fill="currentColor" d="M19 11H5a1 1 0 0 0 0 2h14a1 1 0 0 0 0-2Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="cart" viewBox="0 0 24 24">
          <path fill="currentColor" d="M8.5 19a1.5 1.5 0 1 0 1.5 1.5A1.5 1.5 0 0 0 8.5 19ZM19 16H7a1 1 0 0 1 0-2h8.491a3.013 3.013 0 0 0 2.885-2.176l1.585-5.55A1 1 0 0 0 19 5H6.74a3.007 3.007 0 0 0-2.82-2H3a1 1 0 0 0 0 2h.921a1.005 1.005 0 0 1 .962.725l.155.545v.005l1.641 5.742A3 3 0 0 0 7 18h12a1 1 0 0 0 0-2Zm-1.326-9l-1.22 4.274a1.005 1.005 0 0 1-.963.726H8.754l-.255-.892L7.326 7ZM16.5 19a1.5 1.5 0 1 0 1.5 1.5a1.5 1.5 0 0 0-1.5-1.5Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="check" viewBox="0 0 24 24">
          <path fill="currentColor" d="M18.71 7.21a1 1 0 0 0-1.42 0l-7.45 7.46l-3.13-3.14A1 1 0 1 0 5.29 13l3.84 3.84a1 1 0 0 0 1.42 0l8.16-8.16a1 1 0 0 0 0-1.47Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="trash" viewBox="0 0 24 24">
          <path fill="currentColor" d="M10 18a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1ZM20 6h-4V5a3 3 0 0 0-3-3h-2a3 3 0 0 0-3 3v1H4a1 1 0 0 0 0 2h1v11a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8h1a1 1 0 0 0 0-2ZM10 5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v1h-4Zm7 14a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V8h10Zm-3-1a1 1 0 0 0 1-1v-6a1 1 0 0 0-2 0v6a1 1 0 0 0 1 1Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-outline" viewBox="0 0 15 15">
          <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.5 9.804L5.337 11l.413-2.533L4 6.674l2.418-.37L7.5 4l1.082 2.304l2.418.37l-1.75 1.793L9.663 11L7.5 9.804Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="star-solid" viewBox="0 0 15 15">
          <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="search" viewBox="0 0 24 24">
          <path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="user" viewBox="0 0 24 24">
          <path fill="currentColor" d="M15.71 12.71a6 6 0 1 0-7.42 0a10 10 0 0 0-6.22 8.18a1 1 0 0 0 2 .22a8 8 0 0 1 15.9 0a1 1 0 0 0 1 .89h.11a1 1 0 0 0 .88-1.1a10 10 0 0 0-6.25-8.19ZM12 12a4 4 0 1 1 4-4a4 4 0 0 1-4 4Z"/>
        </symbol>
        <symbol xmlns="http://www.w3.org/2000/svg" id="close" viewBox="0 0 15 15">
          <path fill="currentColor" d="M7.953 3.788a.5.5 0 0 0-.906 0L6.08 5.85l-2.154.33a.5.5 0 0 0-.283.843l1.574 1.613l-.373 2.284a.5.5 0 0 0 .736.518l1.92-1.063l1.921 1.063a.5.5 0 0 0 .736-.519l-.373-2.283l1.574-1.613a.5.5 0 0 0-.283-.844L8.921 5.85l-.968-2.062Z"/>
        </symbol>
      </defs>
    </svg>
<section class="py-5">
      <div class="container">
        
        <div class="row">
        
    <div class=" col-sm-4">

    <div id="price-filter">
      <h5>Price:</h5>
    <div class="form-outline" style="width: 22rem;">
    <div class="form-group">
    <label class="form-label" for="typeNumber">Minimum </label>
    <input  value="0" type="number" id="min-price" name="min-price" class="form-control" />
 
  </div>
</div>
    <div class="form-outline" style="width: 22rem;">
    <div class="form-group">
    <label class="form-label" for="typeNumber">Maximum</label>
    <input value="100" type="number" id="max-price" name="max-price" class="form-control" />
  </div>
</div>


        <input type="hidden" id="category-id" name="category-id" value="<?php echo $cat_id; ?>">
        
        <button id="filter-button" class="btn btn-success">Filter</button>
    </div>

    </div>
    <div class="col-6">

    <div id="product-list">
        <!-- Product list will be displayed here -->

    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function filterProducts(minPrice, maxPrice, categoryId) {
                $.ajax({
                    url: 'filter_products.php',
                    method: 'POST',
                    data: {
                        min_price: minPrice,
                        max_price: maxPrice,
                        category_id: categoryId  // Include category ID in the data sent to filter_products.php
                    },
                    success: function(response) {

                        $('#product-list').html(response);
                        //$('#category-product').hide();
                    }
                    
                });
            }

            // Initial load of all products
            

            $('#filter-button').click(function() {
                const minPrice = $('#min-price').val();
                const maxPrice = $('#max-price').val();
                const categoryId = $('#category-id').val();  // Get category ID from the input field
                filterProducts(minPrice, maxPrice, categoryId);
            });
        });
    </script>

    <div class="col-md-12" id="category-product">
              
            <div class="bootstrap-tabs product-tabs">
              <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                <!-- <h3>Oil & Ghee</h3> -->
                
              </div>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">

                  <div class="product-grid row row-cols-1 row-cols-sm-2 ">
                  <?php
                        while ($row = mysqli_fetch_assoc($all_product)) {
                          $stock=$row['stock'];
                        ?>
    <div class="col">
        <form class="product-item" method="post">
        <button type="submit" class="btn-wishlist" name="wishlist"><svg width="24" height="24"><use xlink:href="#heart"></use></svg></button>
            <figure>
                <a href="productdetails.php?product_id=<?php echo $row['product_id'] ?>" title="Product Title">
                <?php  echo '<img  src="data:images/jpeg;base64,'.base64_encode($row['product_image']).'" class="tab-image" />';?>
                     
                </a>
                <?php if ($stock <= 0) {
        echo '<div class="alert alert-danger" role="alert">
        OUT OF STOCK
      </div>';
    } ?>
            </figure>
            
            <h3><?php echo $row['product_name'] ?></h3>
            <h6><?php echo $row['product_discription'] ?></h6>
            <span class="price"><?php echo "Rs." . $row['unit_price'] ?></span>

            <!-- Hidden input fields for product_id and quantity -->
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            
            <div class="d-flex align-items-center justify-content-between">
                <div class="input-group product-qty col-md-2 border border-secondary border-3">
                    <input type="number" id="quantity" name="quantity" class="form-control" min="1" max="100" value="1">
                </div>

                <?php 
                        if ($stock > 0) {
                          echo '<button type="submit" class="btn btn-default btn-xs pull-right" name="add_to_cart">Add to Cart</button>';
                      }  
                  ?></div>
        </form>
    </div>
<?php
}
?>
                      </div>
                    </div>


    </div>
</div>

          
                  </div>
                  <?php
// Check if the form is submitted
if (isset($_POST['add_to_cart'])) {
    // Get the product_id and quantity from the form submission
    $userId=$_SESSION['id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // You should perform further validation and sanitation of these values here.

    // Assuming you have a database connection established
      echo $product_id;
      echo $quantity;

      $sql = "INSERT INTO tbl_cart_items (product_id,user_id,quantity) VALUES ('$product_id', '$userId','$quantity')";
            if ($conn->query($sql) === TRUE) {
              '<script>
              alert("Product details inserted successfully.");
            </script>';
          
            
       } else {
         echo "Error: " . $conn->error;
       }
        
    // Close the database connection
    mysqli_close($conn);
      }
    if (isset($_POST['wishlist'])){
      $userId=$_SESSION['id'];
      $product_id = $_POST['product_id'];
     
    
      $sql = "INSERT INTO tbl_wishlist (user_id,product_id) VALUES ('$userId','$product_id')";
                if ($conn->query($sql) === TRUE) {
                  echo '<script>
                  alert("Product added to wishlist.");
                </script>';
              
                
           } else {
             echo "Error: " . $conn->error;
           }
            
        // Close the database connection
        mysqli_close($conn);
          }
        
?>
<script src="js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>
</body>
</html>