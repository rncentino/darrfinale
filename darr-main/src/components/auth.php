<?php
require("components/db_conn.php");

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../src/login.php"); 
    exit;
}

if (!isset($_SESSION['firstname']) || !isset($_SESSION['lastname']) || !isset($_SESSION['email']) || !isset($_SESSION['regdate'])) {
    $user_id = $_SESSION['user_id']; 

    $query = "SELECT firstname, lastname, email, reg_date FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['regdate'] = $row['reg_date'];
    } else {
        echo "User data not found!";
        exit;
    }

    $stmt->close();
}
$conn->close();

if (!isset($_SESSION['timestamp'])) {
    $_SESSION['timestamp'] = time();  
} elseif (time() - $_SESSION['timestamp'] > 900) { 
    session_destroy();
    header("Location: ../src/login.php"); 
    exit;
} else {
    $_SESSION['timestamp'] = time();  
}
?>



<script>

function showLogoutToast() {
    Swal.fire({
        icon: "info",
        title: "You are logged out due to user inactivity",
        showConfirmButton: true,
        showClass: {
        popup: `
        animate__animated
        animate__fadeInUp
        animate__faster
        `
    },
    hideClass: {
        popup: `
        animate__animated
        animate__fadeOutDown
        animate__faster
        `
    }
    }).then(() => {
        window.location.href = '../src/login.php';
    });
}

let inactivityTime = function () {
    let time;

    window.onload = resetTimer;
    window.onmousemove = resetTimer;
    window.onmousedown = resetTimer;  
    window.ontouchstart = resetTimer;
    window.onclick = resetTimer;      
    window.onkeypress = resetTimer;   

    function logout() {
        showLogoutToast();
    }

    function resetTimer() {
        clearTimeout(time);
        time = setTimeout(logout, 900000);
    }
};

inactivityTime();
</script>





