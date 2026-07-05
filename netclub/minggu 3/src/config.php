<?php
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_user = getenv('DB_USER') ?: 'novel_user';
$db_pass = getenv('DB_PASS') ?: 'novelpass';
$db_name = getenv('DB_NAME') ?: 'novel_db';

function get_db_connection() {
    global $db_host, $db_user, $db_pass, $db_name;
    
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

session_start();
?>