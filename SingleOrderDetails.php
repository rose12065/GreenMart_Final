<?php
require('connection.php');
require('usernav.php');
if(isset($_GET['order_id'])){
    $orderId=$_GET['order_id'];
    $query="SELECT o.*, p.*, pr.*
    FROM tbl_order o
    INNER JOIN tbl_product p ON o.product_id = p.product_id join tbl_price pr on o.price_id=pr.price_id
    WHERE o.status=0 and o.order_id='$orderId'";
    $all_product=$conn->query($query);

    $order_query="SELECT * From tbl_order where order_id='$orderId'";
    $order=$conn->query($order_query);
    while($rows=mysqli_fetch_assoc($order)){
        $status=$rows['delivery_status'];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <style>
        body {
    letter-spacing: 0.8px;
    background: linear-gradient(0deg , #fff , 50% , #dce2ee);
    background-repeat: no-repeat;    
}

.container-fluid {
    margin-top: 80px !important;
    margin-bottom: 80px !important;
}

p {
    font-size: 14px;
    margin-bottom: 7px;
}

.cursor-pointer {
    cursor: pointer;
}

a{
    text-decoration: none !important;
    color: #100f12 !important;
}

.bold{
    font-weight: 600;
}

.small{
    font-size: 12px !important;
    letter-spacing: 0.5px !important;
}

.Today{
    color: rgb(83, 83, 83);
}

.btn-outline-primary{
    background-color: #fff !important;
    color:#020202 !important;
    border:1.3px solid #acb8b6;
    font-size: 12px;
    border-radius: 0.4em !important;
}

.btn-outline-primary:hover{
    background-color:#8c9291  !important;
    color:#fff !important;
    border:1.3px solid #787c7c;
}

.btn-outline-primary:focus,
.btn-outline-primary:active {
    outline: none !important;
    box-shadow: none !important;
    border-color: #42A5F5 !important;
}
 
#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 33.33%;
    float: left;
    position: relative;
    font-weight: 400;
    color: #455A64 !important;
    
}

#progressbar #step1:before {
    content: "1";
    color: #fff;
    width: 29px;
    margin-left: 15px !important;
    padding-left: 11px !important;
}


#progressbar #step2:before {
    content: "2";
    color: #fff;
    width: 29px;

}

#progressbar #step3:before {
    content: "3";
    color: #fff;
    width: 29px;
    margin-right: 15px !important;
    padding-right: 11px !important;
}

#progressbar li:before {
    line-height: 29px;
    display: block;
    font-size: 12px;
    background: #455A64 ;
    border-radius: 50%;
    margin: auto;
}

 #progressbar li:after {
    content: '';
    width: 121%;
    height: 2px;
    background: #455A64;
    position: absolute;
    left: 0%;
    right: 0%;
    top: 15px;
    z-index: -1;
} 

#progressbar li:nth-child(2):after {
    left: 50%;
}

#progressbar li:nth-child(1):after {
    left: 25%;
    width: 121%;
}
#progressbar li:nth-child(3):after {
    left: 25% !important;
    width: 50% !important;
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #4bb8a9; 
}

.card {
    background-color: #fff ;
    box-shadow: 2px 4px 15px 0px rgb(78, 82, 84);
    z-index: 0;
}

small{
    font-size: 12px !important;
}

.a {
    justify-content: space-between !important;
}

.border-line {
    border-right: 1px solid rgb(226, 206, 226)
}

.card-footer img{
    opacity: 0.3;
}

.card-footer h5{
    font-size: 1.1em;
    color: #8C9EFF;
    cursor: pointer;
}
    </style>
</head>
<body>
   
<div class="container-fluid my-5 d-sm-flex justify-content-center">
    <div class="card px-2">
        <div class="card-header bg-white">
          <div class="row justify-content-between">
            
            <div class="col">
                <a href="your_orders.php"><span class="material-symbols-outlined">arrow_back</span></a>
                <p class="text-muted"> Order ID  <span class="font-weight-bold text-dark"><?php echo $orderId ?></span></p> 
                <p class="text-muted">  <span class="font-weight-bold text-dark"></span> </p></div>
          </div>
          
        </div>
        <div class="card-body">
            <div class="media flex-column flex-sm-row">
                <?php
                    while ($row = mysqli_fetch_assoc($all_product)) {

                ?>
                <div class="media-body ">
                    <h5 class="bold"><?php echo $row["product_name"]; ?></h5>
                    <p class="text-muted"> Qt: <?php echo $row["quantity"]; ?></p>
                    <h4 class="mt-3 mb-4 bold"> <span class="mt-5">&#x20B9;</span> <?php echo $row["unit_price"]; ?></h4> 
                </div>
                <?php echo '<img  src="data:images/jpeg;base64,' . base64_encode($row['product_image']) . '" class="align-self-center img-fluid" width="180 " height="180"/>'; ?>
                <?php 
                    }  
        
        ?>
            </div>
        </div>
        
        <div class="row px-3">
            
            <div class="col">
           
                <ul id="progressbar" >
                <?php
                if($status=="Ordered"){
                    echo '<li class="step0 active " id="step1">PLACED</li>
                    <li class="step0 text-center" id="step2">SHIPPED</li>
                    <li class="step0  text-muted text-right" id="step3">DELIVERED</li>';
                }
                
                if($status=="Shipped"){
                    echo '<li class="step0 active " id="step1">PLACED</li>
                    <li class="step0 active text-center" id="step2">SHIPPED</li>
                    <li class="step0  text-muted text-right" id="step3">DELIVERED</li>';
                }
                if($status=="Delivered"){
                    echo '<li class="step0 active " id="step1">PLACED</li>
                    <li class="step0 active text-center" id="step2">SHIPPED</li>
                    <li class="step0  active text-muted text-right" id="step3">DELIVERED</li>';
                }
                }
                ?>
                    <!-- <li class="step0 active " id="step1">PLACED</li>
                    <li class="step0 active text-center" id="step2">SHIPPED</li>
                    <li class="step0  text-muted text-right" id="step3">DELIVERED</li> -->
                    
                </ul>
                
            </div>
        </div>
         
    </div>
    
</div>
</body>
</html>