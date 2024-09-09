<?php
session_start();
require("../components/db_conn.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../src/login.php"); 
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];

    try {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ? AND user_id != ?");
        $stmt->bind_param("si", $email, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Email already in use by another account.";
        } else {
            $update_stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE user_id = ?");
            $update_stmt->bind_param("sssi", $firstname, $lastname, $email, $user_id);

            if ($update_stmt->execute()) {
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;

                echo "success";
            } else {
                echo "Failed to update profile.";
            }
        }

        $stmt->close();
    } catch (Exception $e) {
        echo "error: " . $e->getMessage();
    }
}

$conn->close();
?>
