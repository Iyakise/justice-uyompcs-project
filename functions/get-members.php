<?php
// FILE: justice/api/get-members.php
define('__mpc_connection__', dirname(__DIR__));
header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Origin: *"); // optional for frontend calls

require_once __mpc_connection__. "/config/conn.php"; // database connection

// ✅ Fetch 50 users
$sql = "SELECT 
            members_id,
            title,
            sex,
            name,
            contact_addr,
            phone,
            members_id,
            lga,
            registration_number
        FROM mpc_members
        ORDER BY name DESC
        LIMIT 50";

$result = mysqli_query($conn, $sql);

if(!$result) {
    echo json_encode([
        "status" => "error",
        "message" => "Database query failed: " . mysqli_error($conn)
    ]);
    exit;
}

$members = [];
while($row = mysqli_fetch_assoc($result)) {
    $members[] = $row;
}

// ✅ Output the data as JSON
echo json_encode([
    "status" => "success",
    "count" => count($members),
    "data" => $members
], JSON_PRETTY_PRINT);
?>
