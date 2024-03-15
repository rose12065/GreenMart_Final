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
    
$sql="SELECT * FROM tbl_category";
        $all_cat = $conn->query($sql);
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
                                    <a href="salesReport.php">
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
                    <h3>Add Products</h3>
                        <div class="row">
        <form action="" method="post" id="product-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"  required></textarea>
            </div>
            <div class="form-group">
                <label for="unitPrice" class="form-label">Unit Price</label>
                <input type="number" class="form-control" id="unitPrice" name="unitPrice" min="1"  required>
            </div>
            <div class="form-group">
                <label for="category" class="form-label">Select Category</label>
                <select id="category" name="category" class="form-control" required>
                    <?php while ($row = mysqli_fetch_assoc($all_cat)) { ?>
                        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['category_name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" min="1"  required>
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Upload Image</label>
                <input class="form-control" type="file" name="image" id="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_product">Add Product</button>
        </form>
    </div>
</div>

                    </div>        
                    </div>
                    <div class="app-wrapper-footer">
                        <div class="app-footer">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 1
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 2
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="app-footer-right">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                Footer Link 3
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="javascript:void(0);" class="nav-link">
                                                <div class="badge badge-success mr-1 ml-0">
                                                    <small>NEW</small>
                                                </div>
                                                Footer Link 4
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>    </div>
                <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
   <?php
    if(isset($_POST['add_product'])){
        $sellerId=$_SESSION['sellerid'];
        $pdtname=$_POST['productName'];
        $price=$_POST['unitPrice'];
        $stock=$_POST['stock'];
        $description=$_POST['description'];
        $cat_id=$_POST['category'];
        $imageData=addslashes(file_get_contents($_FILES['image']['tmp_name']));
        
        $product_name = $_POST["productName"];

        $sql = "SELECT * FROM tbl_product WHERE product_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $product_name);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            echo "<script>alert(' Product name already exists.')
            window.location.href='addedproducts.php';</script>'
            </script> 
            ";

        } else {
            $sql = "INSERT INTO tbl_product (product_name, unit_price, product_discription, category_id, seller_id,product_image,stock,status ) 
            VALUES ('$pdtname', '$price', '$description', '$cat_id ', '$sellerId', '$imageData','$stock',0)";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Product inserted successfully")
            window.location.href="addedproducts.php";</script>';
            
        }
        }
    
        $stmt->close();
    }
    mysqli_close($conn); 

?>
<script>
        // Get the form and input elements
const productForm = document.getElementById("product-form");
const stockInput = document.getElementById("stock");
const unitPriceInput = document.getElementById("unitPrice");

// Function to validate inputs
function validateInputs(event) {
    const stock = parseInt(stockInput.value);
    const unitPrice = parseFloat(unitPriceInput.value);

    if (stock <= 0 || unitPrice <= 0) {
        event.preventDefault(); // Prevent form submission

        if (stock <= 0) {
            alert("Stock must be greater than 0.");
        }

        if (unitPrice <= 0) {
            alert("Unit Price must be greater than 0.");
        }
    }
}

// Add a submit event listener to the form
productForm.addEventListener("submit", validateInputs);

    </script>
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>
</body>
</html>
