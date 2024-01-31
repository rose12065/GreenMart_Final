<?php
 include('connection.php');
 include('usernav.php');
 $id=$_SESSION['id'];
 $sql = "SELECT * FROM tbl_address WHERE user_id=$id";
 $all_addresses=$conn->query($sql);

 $total=0;
 $totalAmount=0;
 $checkoutAmount=0;

 $id = $_SESSION['id'];
$sql = "SELECT c.cart_id, c.product_id, c.quantity, p.product_name, p.unit_price, p.product_discription,p.product_image
        FROM tbl_cart_items c
        INNER JOIN tbl_product p ON c.product_id = p.product_id
        WHERE c.user_id = $id";

$all_products = $conn->query($sql);
 while ($row = mysqli_fetch_assoc($all_products)) {
   $productId = $row['product_id'];
   $productName = $row['product_name'];
   $quantity = $row['quantity'];
   $unitPrice = $row['unit_price'];
   $productDescription = $row['product_discription'];
   $productimage=$row['product_image'];
   $cartid=$row['cart_id'];
   $total = $quantity*$unitPrice;
   $shipcharge=0.00;
   $totalAmount+=$total;
   $checkoutAmount=$shipcharge+$totalAmount;

 }
if (isset($_GET['update_status']) && $_GET['update_status'] === 'true') {
  $updateStatusQuery = "UPDATE tbl_price SET status = 1 WHERE user_id = $id";
  $conn->query($updateStatusQuery);
}
?>
<html>

<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.css"
  rel="stylesheet"
/>
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"
></script>

<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center pb-5">
                    <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
                        <div class="py-4 d-flex flex-row">
                            <h5><span class="far fa-check-square pe-2"></span><b>Billing & Shipping</b> </h5>
                        </div>
                        <h4>Shipping Address</h4>
                        <div class="py-0 d-flex justify-content-end">
                            <h6><a href="add_address.php">Add Address</a></h6>
                        </div>
                        <hr />
                        <form class="pb-3" action=""  method="post" id="myForm">
                            <div class="pt-2">
                                <?php
                                while ($row = mysqli_fetch_assoc($all_addresses)) {
                                    ?>
                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input shipaddress" type="radio"
                                                   name="shipaddress" id="shipaddress"
                                                   value="<?php echo $row['address_id'] ?>" aria-label="..."/>
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0">
                                                <?php echo $row['name'] ?> , <?php echo $row['flat'] ?>,
                                                <?php echo $row['pincode'] ?>
                                                Phone number: <?php echo $row['mobile'] ?>
                                            </p>
                                            <a href="editaddress.php?address_id=<?php echo $row['address_id'] ?>">
                                                <span class="material-symbols-outlined">edit</span>
                                            </a> <br><br>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                    </div>
                    <div class="col-md-5 col-xl-4 offset-xl-1">
                        <div class="py-4 d-flex justify-content-end">
                            <!-- <h6><a href="#!">Cancel and return to website</a></h6> -->
                        </div>
                        <div class="rounded d-flex flex-column p-2" style="background-color: #f8f9fa;">
                            <div class="p-2 me-3">
                                <h4>Order Recap</h4>
                            </div>
                            <div class="border-top px-2 mx-2"></div>
                            <div class="p-2 d-flex pt-3">
                                <div class="col-8">Items Charge</div>
                                <div class="ms-auto"><b><span>&#8377;</span><?php echo $totalAmount ?></b></div>
                            </div>
                            <div class="p-2 d-flex">
                                <div class="col-8">
                                    Shipping Charge <span class="fa fa-question-circle text-dark"></span>
                                </div>
                                <div class="ms-auto"><b>--</b></div>
                            </div>
                            <div class="border-top px-2 mx-2"></div>
                            <div class="p-2 d-flex pt-3">
                                <div class="col-8"><b>Total</b></div>
                                <div class="ms-auto"><b class="text-success" id="checkoutAmount"><span>&#8377;</span><?php echo $checkoutAmount ?></b></div>
                            </div>
                            <div class="rounded d-flex flex-column p-2 mt-3" style="background-color: #f8f9fa;">
                            <div class="p-2 me-3">
                                <h4>Apply Coupon</h4>
                            </div>
                            <p class="customDemo"></p>
                            <div class="border-top px-2 mx-2"></div>
                            <div class="p-2 d-flex pt-3">
                                <div class="col-8">
                                    <input type="text" class="form-control" id="couponCode" name="couponCode" placeholder="Enter coupon code">
                                </div>
                                <div class="ms-auto">
                                    <button type="submit" class="btn btn-secondary" name="coupon-apply" onclick="applyCoupon()">Apply</button>
                                </div>
                            </div>
                            </div>

                            <input type="hidden" name="checkoutAmount" id="checkoutAmount" value="<?php echo $checkoutAmount ?>">
                            <button type="submit" name="pay" class="btn btn-primary btn-block btn-lg">Proceed to Payment</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Add an event listener to the form for the form submission event
    document.getElementById("myForm").addEventListener("submit", function (event) {
        // Get all radio buttons with the "radio-group" class
        var radioButtons = document.getElementsByClassName("shipaddress");

        // Initialize a variable to keep track of whether any radio button is selected
        var atLeastOneSelected = false;

        // Loop through radio buttons to check if at least one is selected
        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                atLeastOneSelected = true;
                break; // Exit the loop if one is selected
            }
        }

        // If none are selected, prevent form submission and show an error message
        if (!atLeastOneSelected) {
            event.preventDefault(); // Prevent form submission
            alert("Please select an address."); // Display an error message
        }
    });


    function applyCoupon() {
        // Get the coupon code entered by the user
        var couponCode = document.getElementById('couponCode').value;

        // Use AJAX to send the coupon code to the server for validation and get the response
        $.ajax({
            type: 'POST',
            url: 'orderpage.php',
            data: { couponCode: couponCode },
            dataType: 'json',
            success: function (response) {
                if (response.error) {
                    // Handle case where the entered coupon code is not valid
                    alert(response.error);
                } else {
                    // Update the checkout amount display with the new amount
                    var checkoutAmountElement = document.getElementById('checkoutAmount');
                    checkoutAmountElement.innerHTML = '&#8377;' + response.newCheckoutAmount;

                    // Update the hidden input value if you need to submit it with the form
                    document.getElementById('checkoutAmountInput').value = response.newCheckoutAmount;
                }
            },
            error: function (error) {
                // Handle AJAX error
                console.log(error);
            }
        });
    }
</script>
<?php 
    $enteredCouponCode = isset($_POST['couponCode']) ? $_POST['couponCode'] : '';
$couponQuery = "SELECT coupon_value FROM tbl_coupon WHERE coupon_code = '$enteredCouponCode'";
$couponResult = $conn->query($couponQuery);

if ($couponResult->num_rows > 0) {
    $couponData = $couponResult->fetch_assoc();
    $couponValue = $couponData['coupon_value'];
    $newCheckoutAmount = $totalAmount - $couponValue;
    $response['newCheckoutAmount'] = $newCheckoutAmount;
    //echo $couponValue;
    echo json_encode($response);



} else {
    $response['error'] = 'Invalid coupon code';
    echo json_encode($response);
}


if (isset($_POST['pay'])) {
  $selectedAddressID = $_POST['shipaddress'];
  $newCheckoutAmount= $_POST['checkoutAmount'];
  $insertQuery = "INSERT INTO tbl_price (user_id,total_amount,checkout_amount, address_id) VALUES ($id,  $totalAmount,$checkoutAmount,$selectedAddressID)";
  
  if ($conn->query($insertQuery)) {
      echo '<script>
        window.location.href = "checkout.php";
        </script>';
      exit();
  } else {
      echo "Error: " . $conn->error;
  }
}


?>
</body>
</html>
