<?php
session_start();
require("components/db_conn.php");

$user_id = $_SESSION['user_id'];

if (!$user_id) {
    header("Location: login.php");
    exit();
}

try {
    $query = "SELECT firstname, lastname, email, regdate FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        
        $_SESSION['Fullname'] = $row['firstname'] . ' ' . $row['lastname'];
        $_SESSION['Email'] = $row['email'];
        $_SESSION['regdate'] = $row['regdate'];
    } else {
        header("Location: error.php");
        exit();
    }
} catch (Exception $e) {
    error_log("Error fetching user data: " . $e->getMessage());
    header("Location: error.php");
    exit();
}

header("Location: profile.php");
exit();
?>
