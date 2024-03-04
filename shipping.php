<?php
require('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Job Application Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #00000; /* Green background color */
            color: #272525; /* Text color */
        }

        .container {
            margin-top: 10px;
        }

        .form-container {
            background-color: #fdf9f9; /* White background for the form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .text-center {
            text-align: center;
        }
    </style>
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

        function validateExperience(){
            var exp = document.forms["myForm"]["experience"].value;
            var ExpPattern = /^(0|10|[1-9])$/;

            if(!exp.match(ExpPattern)){
                document.getElementById("lblErrorExp").innerText = "Enter digit 0-10";
                return false;
            }else {
                document.getElementById("lblErrorExp").innerText = "";
                return true;
            }
        }

        function validateCV(){
            var input = document.getElementById('cv');
            var file = input.files[0];
            var fileName = file.name.toLowerCase();
            var fileSize = file.size;

            // Check if the file is a PDF
            if (!fileName.endsWith('.pdf')) {
                alert('Please select a PDF file.');
                input.value = ''; // Clear the file input
                return false;
            }

            return true;
        }

        function validateForm() {
            return (
                validateName() &&
                validateEmail() &&
                validatePhone() &&
                validateExperience() &&
                validateCV()
            );
        }
    </script>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 form-container">
            <h2 class="mb-4">Agent Registration</h2>
            <form id="jobApplicationForm" name="myForm" onsubmit="return validateForm()"action="" method="post" enctype="multipart/form-data">
                <!-- Name -->
                <div class="form-group">
                    <label for="fullName">Full Name:</label>
                    <input type="text" class="form-control" id="uname" name="uname" onkeyup="validateName()" required>
                    <span id="lblErrorName" style="color: red"></span>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" onkeyup="validateEmail()" required>
                    <span id="lblErrorEmail" style="color: red"></span>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" class="form-control" id="phone" name="phone" onkeyup="validatePhone()"required>
                    <span id="lblErrorPhone" style="color: red"></span>
                </div>

                <!-- Experience -->
                <div class="form-group">
                    <label for="experience">Experience:(in years)</label>
                    <input type="text" class="form-control" id="experience" name="experience" onkeyup="validateExperience()"required>
                    <span id="lblErrorExp" style="color: red"></span>
                </div>

                <!-- CV File Upload -->
                <div class="form-group">
                    <label for="cv">Upload Driving Licence:</label>
                    <input type="file" class="form-control-file" id="cv" name="cv" accept=".pdf" onchange="validateCV(this)" required>
                    <span id="lblErrorCv" style="color: red"></span>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-center">
                    <button type="submit" name="send" class="btn btn-success">Submit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

             $con=mysqli_connect("localhost","root","","greenmart");
             if($con===false){
                 die(Error);
             }


       if (isset($_POST['send'])) {
        $name = $_POST['uname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $experience = $_POST['experience'];

        // File Upload Handling
        $pdfFileName = $_FILES['cv']['name'];
        $pdfFileTmpName = $_FILES['cv']['tmp_name'];

        move_uploaded_file($pdfFileTmpName,"./pdf/".$pdfFileName);
        // Read file content
        // $pdfContent = file_get_contents($pdfFileTmpName);

        // Escape special characters in the file content
        // $pdfContent = mysqli_real_escape_string($con, $pdfContent);

        $emailCheckQuery = "SELECT * FROM tbl_role WHERE email='$email'";
        $emailCheckResult = mysqli_query($con, $emailCheckQuery);
        
        if (mysqli_num_rows($emailCheckResult) > 0) {
            echo "Email is already registered.";
            exit();
        }

        $query="INSERT INTO tbl_role(email, password,  role)  values('$email',NULL,'DELIVERY')";
        if(mysqli_query($con,$query)){
            $sqlselect="SELECT role_id FROM tbl_role";
            $selectResult=mysqli_query($con,$sqlselect);
            while($row=mysqli_fetch_assoc($selectResult)) {
                $role_id=$row['role_id'];
            }


        $sql = "INSERT INTO tbl_delivery_register(role_id,agent_name, phone, experience, cv, status)  
                VALUES($role_id,'$name','$phone','$experience','$pdfFileName', 0)";
        if (mysqli_query($con, $sql)) {
            echo '<script>
                    if(window.confirm("Registration successful"))
                    {
                        window.location.href="login.php";
                    }
                  </script>';
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
}





         ?>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JavaScript for form validation -->
<script>
    function validateForm() {
        var fullName = document.getElementById("fullName").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var address = document.getElementById("address").value;
        var experience = document.getElementById("experience").value;

        // Simple validation examples; you can add more specific checks based on your requirements
        if (fullName === "" || email === "" || phone === "" || address === "" || experience === "") {
            alert("Please fill out all fields.");
            return false;
        }

        // You can add more complex validation logic here

        return true; // Form submission will proceed if this function returns true
    }
</script>

</body>
</html>
