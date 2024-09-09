<?php
require('components/db_conn.php');

// no of files
$file_count_query = "SELECT COUNT(*) AS file_count FROM records";
$file_result = $conn->query($file_count_query);
$file_count = $file_result->fetch_assoc()['file_count'];

// no of records
$record_count_query = "SELECT COUNT(*) AS record_count FROM records";
$record_result = $conn->query($record_count_query);
$record_count = $record_result->fetch_assoc()['record_count'];

// no of users
$user_count_query = "SELECT COUNT(*) AS user_count FROM users";
$user_result = $conn->query($user_count_query);
$user_count = $user_result->fetch_assoc()['user_count'];
