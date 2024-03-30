<?php
    require('../connection.php');
    //session_start();
    $adminId=$_SESSION['adminid'];
    $sql="SELECT * FROM tbl_admin_register WHERE admin_id=$adminId";
    $all_admin = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($all_admin)){
        $adminName=$row['admin_name'];
        $adminMobile=$row['admin_mobile'];
        $adminEmail=$row['admin_email'];
    }
    
    $sql_orderTotal="SELECT COUNT(DISTINCT order_id) AS total_orders
    FROM tbl_order
    WHERE delivery_status IN ('Shipped', 'Ordered');
    ";
    $total_orderCount = $conn->query($sql_orderTotal);
    while($row=mysqli_fetch_assoc($total_orderCount)){
        $totalOrder=$row['total_orders'];
    }
    if (isset($_GET['category_id'])) {
        $categoryId = $_GET['category_id'];
    $sql_category="SELECT * FROM tbl_category where category_id=$categoryId";
    $all_category = $conn->query($sql_category);
    while($row=mysqli_fetch_assoc($all_category)){
        $catName=$row['category_name'];
    }

    if(isset($_POST['edit_cat'])){
        $new_cat_name=$_POST['category'];
        $sql_category="SELECT * FROM tbl_category WHERE category_name= '$new_cat_name'";
        $catCheckResult = mysqli_query($conn,  $sql_category);
        if (mysqli_num_rows($catCheckResult) > 0) {  
            
            echo"<script>
            alert('The category already exsit');
            window.location.href='viewCategory.php';</script>";  
            exit();
        }
        $sql_update="UPDATE tbl_category SET category_name='$new_category_name' WHERE category_id='$categoryId'";
        if ($conn->query($sql_update) === TRUE) {

            echo"alert('The category edited succesfully');
            <script>window.location.href='viewCategory.php';</script>";
            
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

$sql_seller_count="SELECT COUNT(*) as total_seller
    FROM tbl_seller_register
    Where status=0";
    $total_seller_count = $conn->query($sql_seller_count);
    while($row=mysqli_fetch_assoc($total_seller_count)){
        $totalSellerCount=$row['total_seller'];
    }

    $sql_agent_count="SELECT COUNT(*) as total_agent
    FROM tbl_delivery_register
    Where status=0";
    $total_agent_count = $conn->query($sql_agent_count);
    while($row=mysqli_fetch_assoc($total_agent_count)){
        $totalAgentCount=$row['total_agent'];

        $sql_report="SELECT 
    p.product_id,
    p.product_name,
    SUM(o.quantity) AS total_quantity_sold,
    SUM(o.quantity * o.unit_price) AS total_revenue
    FROM 
    tbl_order o
    JOIN 
    tbl_product p ON o.product_id = p.product_id
    GROUP BY 
    p.product_id, p.product_name
    order by total_quantity_sold desc";

    $report=$conn->query($sql_report);
    
    $sql_monthly_report=" SELECT 
        MONTH(o.order_date) AS month,
        SUM(o.quantity * o.unit_price) AS total_revenue
    FROM 
        tbl_order o
    JOIN 
        tbl_product p ON o.product_id = p.product_id
    GROUP BY 
        MONTH(o.order_date)
    ";
    $result_monthly_report=$conn->query($sql_monthly_report);
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
<link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/pe-icon-7-stroke.css">

<!-- Optional - Adds useful class to manipulate icon font display -->
<link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/helper.css">
<style>
    .scrollbar-sidebar {
    height: calc(100vh - 60px); /* Adjust the height as needed */
    overflow-y: auto;
}
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        h1, h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }
       
</style>
</style>
</head>

</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <!-- <div class="logo-src"></div> -->
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>    <div class="app-header__content">
                <div class="app-header-left">
                    <div class="search-wrapper">
                        
                        <button class="close"></button>
                    </div>
                           </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">

                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                       <?php echo $adminName ; ?>
                                    </div>
                                    <div class="widget-subheading">
                                        Admin
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>        </div>
            </div>
        </div>        <div class="ui-theme-settings">
            <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
            </button>
        </div>        
        <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
                    </div>    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="admindashboard.php" class="mm-active">
                                    <i class="fa fa-dashboard"></i>
                                        Dashboard 
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Customer</li>
                                <li>
                                    <a href="viewCustomer.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        View Customer
                                    </a>
                                    <a href="orderDetails.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Order
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-success"><?php echo $totalOrder ; ?></span>
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Seller</li>
                                <li>
                                    <a href="sellerDetails.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                         Seller Details
                                         <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-success"><?php echo $totalSellerCount ; ?></span>
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Shipping </li>
                                <li>
                                    <a href="delivery.php">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                          Delivery Agent
                                          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-success"><?php echo $totalAgentCount ; ?></span>
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Category</li>
                                <li>
                                    <a href="addCategory.php">
                                        <i class="metismenu-icon pe-7s-mouse">
                                        </i>Add Category
                                    </a>
                                </li>
                                <li>
                                    <a href="viewCategory.php">
                                        <i class="metismenu-icon pe-7s-eyedropper">
                                        </i>View Category
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Products</li>
                                <li>
                                    <a href="viewProducts.php">
                                        <i class="metismenu-icon pe-7s-graph2">
                                        </i>View Products
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Report</li>
                                <li>
                                    <a href="salesReport.php">
                                        <i class="metismenu-icon pe-7s-graph2">
                                        </i>Sales Report
                                    </a>
                                </li>
                                <li class="app-sidebar__heading"><a href="../logout.php">LOGOUT</a></li>
                            </ul>
                        </div>
                    </div>
                </div>    <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                        </i>
                                    </div>
                                    <div>Hello, <?php echo $adminName ; ?>,
                                        <div class="page-title-subheading">Welcome to the heart of our online ecosystem. The Admin Dashboard is your command center for managing our platform. 
                                        </div>
                                    </div>
                                </div>
                              </div> 
                        </div>
                        
                    <div class="row ">
                            
                    <div class="container">
    <h1>Sales Report <a id= "dwld_report" href="ReportPdf.php" download="ReportPdf.pdf" class="download-button"><span class="material-symbols-outlined">
download
</span></a></h1>
        <p>Date: <?php echo date('Y-m-d'); ?></p>
        
        <h2>Overall Sales Summary</h2>
        <table>
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total Sales</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    while($row=mysqli_fetch_assoc($result_monthly_report)){
                    
                ?>
                <!-- Loop through sales data to populate table rows -->
                <tr>
                    <td><?php echo date("F", mktime(0, 0, 0, $row['month'], 1)) ?></td>
                    <td><?php echo $row['total_revenue'] ?></td>
                </tr>
                <!-- Add more rows as needed -->
                <?php
                    }
                ?>
            </tbody>
        </table>

        <h2>Product-wise Sales</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity Sold</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row=mysqli_fetch_assoc($report)){
                    
                ?>
                <!-- Loop through product sales data to populate table rows -->
                <tr>
                    <td><?php echo $row['product_name'] ?></td>
                    <td><?php echo $row['total_quantity_sold'] ?></td>
                    <td><?php echo $row['total_revenue']?></td>
                </tr>
                <!-- Add more rows as needed -->
                <?php
                    }
                ?>
            </tbody>
        </table>

        <div class="footer">
            Generated by GreenMart &bull; <?php echo date('Y'); ?>
        </div>
    </div>
                        </div>

                    </div>        
                   
                       </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
                            
                    </div>


                <br><br>


                <footer class="text-center text-lg-start bg-body-tertiary text-muted ">
 
 <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
   © 2024 Copyright:
   <a class="text-reset fw-bold" href="#">GreenMart</a>
 </div>
</footer>   </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script></body>
</html>
