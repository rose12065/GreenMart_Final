<?php
    require('connection.php');
    require('usernav.php');
    $id=$_SESSION['id'];
    $query="SELECT o.*, GROUP_CONCAT(p.product_name SEPARATOR ', ') AS product_names, pr.*
    FROM tbl_order o
    INNER JOIN tbl_product p ON o.product_id = p.product_id join tbl_price pr on o.price_id=pr.price_id
    WHERE o.user_id = $id and o.status=0 Group by order_id order by o.order_date desc";

    $all_product=$conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Orders History</h2>
        
        <!-- Bootstrap Table to Display Orders -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Bill</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
<?php
 if (mysqli_num_rows($all_product) > 0) 
 {

while ($row = mysqli_fetch_assoc($all_product)) {
?>

                <tr>
                    <td><?php echo $row['order_id']; ?></td>
                    <td><?php echo $row['product_names']; ?></td>
                    <td><?php echo $row['order_date']; ?></td>
                    <td><?php echo $row['checkout_amount']; ?></td>

                    <?php
                        if ($row['delivery_status']=='Delivered'){
                            echo'<td><span class="badge badge-success">Delivered</span></td>';
                        }
                        else if($row['delivery_status']=='Shipped'){
                            echo'<td><span class="badge badge-warning">Shipped</span></td>';
                        }
                        else if($row['delivery_status']=='Ordered'){
                            echo'<td><span class="badge badge-warning">Ordered</span></td>';
                        }
                ?>     
                    <td>
                       <a href="BillPdf.php ?  order_id=<?php echo $row['order_id'] ?>"><i class="fa fa-print"></i></a>
                    </td>
                    <td>
                    <a href="SingleOrderDetails.php ?order_id=<?php echo $row['order_id'] ?> "><span class="badge badge-info">More Info</span></a>
                    <?php
                            if($row['delivery_status']=='Delivered'){

                            }
                            else{
                                ?>
                                <a href="cancelOrder.php ?order_id=<?php echo $row["order_id"] ?>" onclick="return confirm('Are you sure?')"><span class="badge badge-danger"> Cancel</span></a>
                           
                           <?php
                            }
                    ?>
                </td>
                </tr>
                              <?php
}
 }
 else{
    echo '<div class="alert alert-info" role="alert">
            <span><h5>No orders </h5></span>
          </div>';
 }
                ?>
            </tbody>
        </table>
        
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
