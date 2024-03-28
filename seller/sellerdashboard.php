<?php
    require('../connection.php');
    //session_start();

    $seller=$_SESSION['sellerid'];

    $sql="SELECT s.*, r.email AS role_email
    FROM tbl_seller_register s
    JOIN tbl_role r ON s.role_id = r.role_id
    WHERE s.role_id = $seller";
    $all_seller = $conn->query($sql);
    while ($row = mysqli_fetch_assoc($all_seller)){
        $sellerName=$row['seller_name'];
        $sellerMobile=$row['seller_mobile'];
        $sellerEmail=$row['role_email'];
        $company=$row['company'];
    }

    $sql_total_product="SELECT COUNT(*) AS num_products
    FROM tbl_product
    WHERE seller_id = $seller";
    $all_product = $conn->query($sql_total_product);
    while ($row = mysqli_fetch_assoc($all_product)){
        $totalProducts=$row['num_products'];
    }

    $sql_chart = "SELECT o.order_date
    FROM tbl_order o
    JOIN tbl_product p ON o.product_id = p.product_id
    WHERE p.seller_id = $seller";
    $result = mysqli_query($conn, $sql_chart);
    $monthlySalesData = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $orderDate = $row['order_date'];
            $monthYear = date('F Y', strtotime($orderDate));
            if (array_key_exists($monthYear, $monthlySalesData)) {
                $monthlySalesData[$monthYear]++;
            } else {
                $monthlySalesData[$monthYear] = 1;
            }
        }
    }

    $sql_most_sold_pdt = "SELECT p.product_id, p.product_name, COUNT(*) AS num_orders
        FROM tbl_order o
        JOIN tbl_product p ON o.product_id = p.product_id
        WHERE p.seller_id = $seller
        GROUP BY p.product_id, p.product_name
        ORDER BY num_orders DESC
        LIMIT 4";

    $result = $conn->query($sql_most_sold_pdt);

    // Initialize an empty array to store the results
    $mostSoldProducts = array();

    // Check if the query was successful and fetch the results into an array
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mostSoldProducts[] = $row; // Add each row to the array
        }
    } else {
        echo "No results found.";
    }

    ?>
 

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Vendor Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
<link href="https://demo.dashboardpack.com/architectui-html-free/main.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/pe-icon-7-stroke.css">

<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"/>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Optional - Adds useful class to manipulate icon font display -->
<link rel="stylesheet" href="path/to/pe-icon-7-stroke/css/helper.css">
<style>
    .scrollbar-sidebar {
    height: calc(100vh - 60px); /* Adjust the height as needed */
    overflow-y: auto;
}

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
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <!-- <img width="42" class="rounded-circle" src="" alt=""> -->
                                           
                                        </a>
                                       
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                       <?php echo $sellerName ; ?>
                                    </div>
                                    <div class="widget-subheading">
                                        Seller
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
                    </div>    
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Dashboard</li>
                                <li>
                                    <a href="sellerdashboard.php" class="mm-active">
                                    <i class="fa fa-dashboard"></i>
                                        Dashboard 
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Products</li>
                                <li>
                                    <a href="addproduct.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Add Products
                                    </a>
                                    <a href="addedproducts.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        View Products
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-success"></span>
                                    </a>
                                    <a href="productArchives.php">
                                        <i class="metismenu-icon pe-7s-diamond"></i>
                                        Archived Products
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill badge-success"></span>
                                    </a>
                                </li>
                                <li class="app-sidebar__heading">Reports</li>
                                <li>
                                    <a href="salesReport.php" id="report">
                                        <i class="metismenu-icon pe-7s-display2"></i>
                                         Sales Report
                                    </a>
                                </li>
                                
                                <li class="app-sidebar__heading"><a href="../logout.php">LOGOUT</a></li>
                            </ul>
                        </div>
                    </div>
                </div>    
                <div class="app-main__outer">
                    <div class="app-main__inner">
                        <div class="app-page-title">
                            <div class="page-title-wrapper">
                                <div class="page-title-heading">
                                    <div class="page-title-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                        </i>
                                    </div>
                                    <div>Hello, <?php echo $sellerName ; ?>,
                                        <div class="page-title-subheading">Welcome to the heart of our online ecosystem. 
                                        </div>
                                    </div>
                                </div>
                              </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content bg-midnight-bloom">
                                    <div class="widget-content-wrapper text-white">
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Total Products</div>
                                            <div class="widget-subheading"></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span><?php echo $totalProducts; ?></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-xl-4">
                                <div class="card mb-3 widget-content">
                                    <div class="widget-content-wrapper text-black">
                                        <div class="widget-content-left">
                                            <div class="widget-heading"><?php echo $sellerName ; ?></div>
                                            <div class="widget-subheading"><b>Phone : <?php echo $sellerMobile ; ?><br>Email : <?php echo $sellerEmail ; ?><br>Company : <?php echo $company ; ?></b></div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="widget-numbers text-white"><span></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-3 card">
                                    <div class="card-header-tab card-header-tab-animation card-header">
                                        <div class="card-header-title">
                                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                                            Sales Report
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tabs-eg-77">
                                                <div class="card mb-3 widget-chart widget-chart2 text-left w-100">
                                                    <div class="widget-chat-wrapper-outer">
                                                        <div class="widget-chart-wrapper widget-chart-wrapper-lg opacity-10 m-0">
                                                        <canvas id="salesChart"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-3 card">
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="tab-eg-55">
                                            <div class="widget-chart p-3">
                                                <div class="widget-chart-content text-center mt-5">
                                                    <div class="widget-description mt-0 text-warning">
                                                        <i class="fa fa-arrow-left"></i>
                                                        <span class="pl-1"></span>
                                                        <span class="text-muted opacity-8 pl-1">MOST SOLD PRODUCTS</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pt-2 card-body">
                                            



                                                <div class="row">
                                                <?php
                                                // Array of colors for the progress bars
                                                $progressColors = array('bg-primary', 'bg-success', 'bg-info', 'bg-warning');

                                                // Your PHP code to fetch the top 4 most sold products goes here...

                                                // HTML code to display the top 4 most sold products
                                                $index = 0; // Index to track the color from the array
                                                foreach ($mostSoldProducts as $product) {
                                                    ?>
                                                    <div class="col-md-6">
                                                        <div class="widget-content">
                                                            <div class="widget-content-outer">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left">
                                                                        <div class="widget-numbers fsize-3 text-muted"><?php echo $product['num_orders']; ?>%</div>
                                                                    </div>
                                                                    <div class="widget-content-right">
                                                                        <div class="text-muted opacity-6"><?php echo $product['product_name']; ?></div>
                                                                    </div>
                                                                </div>
                                                                <div class="widget-progress-wrapper mt-1">
                                                                    <div class="progress-bar-sm progress-bar-animated-alt progress">
                                                                        <div class="progress-bar <?php echo $progressColors[$index]; ?>" role="progressbar" aria-valuenow="<?php echo $product['num_orders']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $product['num_orders']; ?>%;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    // Increment the index to get the next color
                                                    $index++;
                                                    // Reset the index if it exceeds the length of the progressColors array
                                                    if ($index >= count($progressColors)) {
                                                        $index = 0;
                                                    }
                                                }
                                            ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>GreenMart
          </h6>
          <p>
          GreenMart:  Your one-stop shop for convenience and quality.
          </p>
        </div>
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="sellerdashboard.php" class="text-reset">Dashboard</a>
          </p>
          <p>
            <a href="addproduct.php" class="text-reset">Add Product</a>
          </p>
          <p>
            <a href="addedproducts.php" class="text-reset">View Product</a>
          </p>
          <p>
            <a href="salesReport.php" class="text-reset">Report</a>
          </p>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Ranni, Pathanamthitta</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            greenmart893@gmail.com
          </p>
          <p><i class="fas fa-phone me-3"></i> 7306897518</p>
          <p><i class="fas fa-print me-3"></i> 8874598715</p>
        </div>
      </div>
    </div>
  </section>
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-reset fw-bold" href="#">GreenMart</a>
  </div>
</footer>
<!-- Footer -->

   </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script>
        var salesData = <?php echo json_encode($monthlySalesData); ?>;
        var labels = Object.keys(salesData);
        var values = Object.values(salesData);
        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales Report',
                    data: values, 
                    backgroundColor: 'rgba(0, 100, 0, 0.2)', // Dark green background color
                    borderColor: 'rgba(0, 100, 0, 1)', 
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script></body>
</html>
