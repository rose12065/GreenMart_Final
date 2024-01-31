<html>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</html>
<?php
require("../connection.php");
require '../vendor/autoload.php';

function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

if (isset($_GET['agent_id'])) {
    $agentId = $_GET['agent_id'];
    $generatedPassword = generateRandomPassword();

    $sql_delivery = "SELECT * FROM tbl_delivery_register
    JOIN tbl_role ON tbl_delivery_register.role_id = tbl_role.role_id
    WHERE tbl_delivery_register.role_id = $agentId";
    $result = $conn->query($sql_delivery);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $agent_name = $row['agent_name'];
        $agent_email = $row['email'];
        $agent_status = $row['status'];

        // Insert role for the agent
        $sql_insert = "UPDATE tbl_role SET password = '$generatedPassword' WHERE role_id = $agentId ";
        if ($conn->query($sql_insert) === TRUE) {
            // Update agent status
            $sql_update = "UPDATE tbl_delivery_register SET status = 1 WHERE role_id = $agentId";
            if ($conn->query($sql_update) === TRUE) {
                // Send email to the agent
                require("../Mail/phpmailer/PHPMailerAutoload.php");
                $mail = new PHPMailer;
                $mail->SMTPDebug = 0;  // Set to 2 for debugging
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'rosemariaroy2024@mca.ajce.in';
                $mail->Password = 'jkwi tfhk kxjh eewx';
                $mail->SMTPSecure = 'tls';
                
                $mail->Port = 587;

                $mail->setFrom('rosemariaroy2024@mca.ajce.in', 'GreenMart');
                $mail->addAddress($agent_email, $agent_name);

                $mail->isHTML(true);
                $mail->Subject = 'Account created successfully';
                $mail->Body = 'Thank You for being a part of GreenMart. Here you can login to your account using your mail id.<br>Your password is '. $generatedPassword;
                $mail->AltBody = '<br><br>
                <p>With regrads,</p>
                <b>GreenMart</b>"; ';

                if ($mail->send()) {?>
                    <!-- <div class="alert alert-success">
                    <strong>Success!</strong> Mail has been sent successfully!
                    </div> -->
                   <?php
                   echo'<script>window.location.href="delivery.php";</script>';
                    //echo "Mail has been sent successfully!";
                } else {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo "Error updating agent status: " . $conn->error;
            }
        } else {
            echo "Error inserting role: " . $conn->error;
        }
    } else {
        echo "Agent not found.";
    }
} else {
    echo "Agent ID not provided.";
}

mysqli_close($conn);
?>
