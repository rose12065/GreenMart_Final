
<?php
    include('navbar.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User & Seller Registration</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="js/myscripts.js"> </script>
</head>
<script>
        function validateName() {
            var name = document.forms["myForm"]["uname"].value;
            var namePattern = /^[A-Za-z\s]+$/;

            if (!name.match(namePattern)) {
                document.getElementById("lblErrorName").innerText = "Name should contain only alphabet characters.";
                return false;
            } else {
                document.getElementById("lblErrorName").innerText = "";
                return true;
            }
        }

        function validateEmail() {
            var email = document.forms["myForm"]["email"].value;
            var emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

            if (!email.match(emailPattern)) {
                document.getElementById("lblErrorEmail").innerText = "Invalid email address.";
                return false;
            } else {
                document.getElementById("lblErrorEmail").innerText = "";
                return true;
            }
        }

        function validatePhone() {
            var phone = document.forms["myForm"]["phone"].value;
            var phonePattern = /^[6-9]\d{9}$/;

            if (!phone.match(phonePattern)) {
                document.getElementById("lblErrorPhone").innerText = "Invalid phone number.";
                return false;
            } else {
                document.getElementById("lblErrorPhone").innerText = "";
                return true;
            }
        }

        function validatePassword() {
            var password = document.forms["myForm"]["pwd"].value;
            var passwordPattern = /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;

            if (!password.match(passwordPattern)) {
                document.getElementById("lblErrorPass").innerText = "Password should be 6-16 characters, with at least one special character and one number.";
                return false;
            } else {
                document.getElementById("lblErrorPass").innerText = "";
                return true;
            }
        }

        function validateRepeatPassword() {
            var password = document.forms["myForm"]["pwd"].value;
            var repeatPassword = document.forms["myForm"]["repeat-pwd"].value;

            if (password !== repeatPassword) {
                document.getElementById("lblErrorRepeatPass").innerText = "Passwords do not match.";
                return false;
            } else {
                document.getElementById("lblErrorRepeatPass").innerText = "";
                return true;
            }
        }

        function validateForm() {
            return (
                validateName() &&
                validateEmail() &&
                validatePhone() &&
                validatePassword() &&
                validateRepeatPassword()
            );
        }

        function validateSellerName() {
            var name = document.forms["sellerForm"]["name"].value;
            var namePattern = /^[A-Za-z\s]+$/;

            if (!name.match(namePattern)) {
                document.getElementById("nameError").innerText = "Name should contain only alphabet characters.";
                return false;
            } else {
                document.getElementById("nameError").innerText = "";
                return true;
            }
        }
        function validatecompany() {
            var name = document.forms["sellerForm"]["company"].value;
            var namePattern = /^[A-Za-z\s]+$/;

            if (!name.match(namePattern)) {
                document.getElementById("comapnyError").innerText = "Company should contain only alphabet characters.";
                return false;
            } else {
                document.getElementById("comapnyError").innerText = "";
                return true;
            }
        }


        function validateSellerEmail() {
            var email = document.forms["sellerForm"]["email"].value;
            var emailPattern = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;

            if (!email.match(emailPattern)) {
                document.getElementById("emailError").innerText = "Invalid email address.";
                return false;
            } else {
                document.getElementById("emailError").innerText = "";
                return true;
            }
        }

        function validateSellerPhone() {
            var phone = document.forms["sellerForm"]["phone"].value;
            var phonePattern = /^[6-9]\d{9}$/;

            if (!phone.match(phonePattern)) {
                document.getElementById("phoneError").innerText = "Invalid phone number.";
                return false;
            } else {
                document.getElementById("phoneError").innerText = "";
                return true;
            }
        }

        function validateSellerPassword() {
            var password = document.forms["sellerForm"]["pwd"].value;
            var passwordPattern = /^[a-zA-Z0-9!@#$%^&*]{6,16}$/;

            if (!password.match(passwordPattern)) {
                document.getElementById("passwordError").innerText = "Password should be 6-16 characters, with at least one special character and one number.";
                return false;
            } else {
                document.getElementById("passwordError").innerText = "";
                return true;
            }
        }

        function validateSellerRepeatPassword() {
            var password = document.forms["sellerForm"]["pwd"].value;
            var repeatPassword = document.forms["sellerForm"]["repeat-pwd"].value;

            if (password !== repeatPassword) {
                document.getElementById("repeatPasswordError").innerText = "Passwords do not match.";
                return false;
            } else {
                document.getElementById("repeatPasswordError").innerText = "";
                return true;
            }
        }

        function validateSellerForm() {
            return (
                validateSellerName() &&
                validateSellerEmail() &&
                validatecompany()&&
                validateSellerPhone() &&
                validateSellerPassword() &&
                validateSellerRepeatPassword()
            );
        }
        
</script>
<body>

<div class="container mt-5">
    <ul class="nav nav-tabs" id="registrationTabs">
        <li class="nav-item">
            <a class="nav-link active" id="userTab" data-toggle="tab" href="#userRegistration">User Registration</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="sellerTab" data-toggle="tab" href="#sellerRegistration">Seller Registration</a>
        </li>
    </ul>

    <div class="tab-content mt-3">
        <!-- User Registration Form -->
        <div id="userRegistration"  class="tab-pane fade show active">
            <form  name="myForm" onsubmit="return validateForm()" action="" method="post">
                <!-- User registration form fields go here -->
                <h2>User Registration</h2>
                <div class="form-group col-md-3" >
                
                <input type="text" class="form-control" id="uname" name="uname" placeholder="Name" onkeyup="validateName()" required>
                <span id="lblErrorName" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
                
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" onkeyup="validateEmail()" required>
                <span id="lblErrorEmail" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Mobile Number" onkeyup="validatePhone()"required>
                <span id="lblErrorPhone" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" onkeyup="validatePassword()" required>
                <span id="lblErrorPass" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
                
                <input type="password" class="form-control" id="repeat-pwd" name="repeat-pwd" placeholder="Repeat Password" onkeyup="validateRepeatPassword()" required>
                <span id="lblErrorRepeatPass" style="color: red"></span>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="send" id="send" class="btn btn-success" onclick="validateRegister()">Register As User</button></form>
            <p>Already have an account <a href="login.php">Login</a></p>
        </div>

        <!-- Seller Registration Form -->
        <div id="sellerRegistration" class="tab-pane fade">
            <form  name="sellerForm" onsubmit="return validateSellerForm()" action="" method="post">
                <!-- Seller registration form fields go here -->
                <h2>Seller Registration</h2>
                <div class="form-group col-md-3" >
                
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" onkeyup="validateSellerName()" required>
                <span id="nameError" style="color: red"></span>
            </div>
            <div class="form-group col-md-3" >
            <input type="text" class="form-control" id="company" name="company" placeholder="Company" onkeyup="validatecompany()" required>
                <span id="comapnyError" style="color: red"></span>
                
            </div>
            <div class="form-group col-md-3">
                
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" onkeyup="validateSellerEmail()" required>
                <span id="emailError" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" placeholder="Mobile Number" onkeyup="validateSellerPhone()"required>
                <span id="phoneError" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
               
                <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" onkeyup="validateSellerPassword()" required>
                <span id="passwordError" style="color: red"></span>
            </div>
            
            <div class="form-group col-md-3">
                
                <input type="password" class="form-control" id="repeat-pwd" name="repeat-pwd" placeholder="Repeat Password" onkeyup="validateSellerRepeatPassword()" required>
                <span id="repeatPasswordError" style="color: red"></span>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" name="sendseller" id="sendseller" class="btn btn-success" onclick="validateRegister()">Register As seller</button>
            </form>
            <p>Already have an account <a href="login.php">Login</a></p>
        </div>
    </div>
</div>
<?php
             $con=mysqli_connect("localhost","root","","greenmart");
             if($con===false){
                 die(Error);
             }
            if(isset($_POST['send']))
            {
             $name = $_POST['uname'];
             $email = $_POST['email'];
             $phone=$_POST['phone'];
             $pwd = $_POST['pwd'];
             //$hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
             

             $emailCheckQuery = "SELECT * FROM tbl_role WHERE email='$email' and role='customer'";
             $emailCheckResult = mysqli_query($con, $emailCheckQuery);
            
             if (mysqli_num_rows($emailCheckResult) > 0) {
                 echo "Email is already registered.";
                 exit();
             }
             $query="INSERT INTO tbl_role(email, password,  role)  values('$email','$pwd','customer')";
             if(mysqli_query($con,$query)){
                $sqlselect="SELECT role_id FROM tbl_role";
                $selectResult=mysqli_query($con,$sqlselect);
                while($row=mysqli_fetch_assoc($selectResult)) {
                    $role_id=$row['role_id'];
                }

                 $sql="INSERT INTO tbl_user_register(role_id,user_name,user_mobile,status)  values('$role_id','$name',$phone,1)";
                 if(mysqli_query($con,$sql))
                 {?>
                  <script>
                  if(window.confirm('Registration succsesful'))
                   {
                   window.location.href='login.php';
                   header("Location: login.php");
                   };
                 </script><?php
                 }
                }
                 else{
                     echo"Error";
                 }
            
            
         }
           
           if(isset($_POST['sendseller']))
           {
            $name = $_POST['name'];
            $company=$_POST['company'];
            $email = $_POST['email'];
            $phone=$_POST['phone'];
            $pwd = $_POST['pwd'];

            $emailCheckQuery = "SELECT * FROM tbl_role WHERE email='$email' and role='seller'";
            $emailCheckResult = mysqli_query($con, $emailCheckQuery);
            
            if (mysqli_num_rows($emailCheckResult) > 0) {
                echo "Email is already registered.";
                exit();
            }
            $query="INSERT INTO tbl_role(email, password,  role)  values('$email','$pwd','seller')";
             if(mysqli_query($con,$query)){
                $sqlselect="SELECT role_id FROM tbl_role";
                $selectResult=mysqli_query($con,$sqlselect);
                while($row=mysqli_fetch_assoc($selectResult)) {
                    $role_id=$row['role_id'];
                }

                 $sql="INSERT INTO tbl_seller_register(role_id,seller_name,seller_mobile,company,status)  values('$role_id','$name',$phone,'$company',0)";
                 if(mysqli_query($con,$sql))
                 {?>
                  <script>
                  if(window.confirm('Registration succsesful'))
                   {
                   window.location.href='login.php';
                   header("Location: login.php");
                   };
                 </script><?php
                 }
                }
                 else{
                     echo"Error";
                 }
        }
           mysqli_close($con); 
        
  ?>
<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
