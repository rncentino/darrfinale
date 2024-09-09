<?php
session_start();
require('components/db_conn.php');

$response = array('success' => false, 'message' => '');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    
    $sql = "SELECT user_id, firstname, lastname, email, password FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);


            // hashed password
            // if (password_verify($password, $user['password'])) {
            //     $_SESSION['loggedin'] = true;
            //     $_SESSION['user_id'] = $user['user_id']; 
            //     $response['success'] = true;
            // } else {
            //     $response['message'] = "Incorrect password. Please try again.";
            // }

            // text password
            if ($user['password'] === $password) {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user['user_id']; 
                
                $response['success'] = true;
            } else {
                $response['message'] = "Incorrect password. Please try again.";
            }
        } else {
            $response['message'] = "Email not found. Please register or check your email.";
        }
    } else {
        $response['message'] = "An error occurred while processing your request.";
    }
} else {
    $response['message'] = "Invalid request method.";
}

echo json_encode($response);
?>
