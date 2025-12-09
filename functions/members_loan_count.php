<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

header("Content-Type: application/json");

// Only POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
// echo json_encode(["status" => "error", "message" => print_r($input, true)]);
// die;
if (!$input || !isset($input["member_id"]) || !isset($input["members_phone"])) {
    echo json_encode(["status" => "error", "message" => "Invalid or missing parameters"]);
    exit;
}


$member_id    = intval($input["member_id"]);
$member_phone = $input["members_phone"];

// Prepare SQL
$sql = "
    SELECT 
        (SELECT COUNT(*) FROM mpc_loans WHERE member_id = ? AND status = 'pending') +
        (SELECT COUNT(*) FROM mpc_special_loan WHERE member_id = ? AND status = 'pending') 
        AS total_pending
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["status" => "error", "message" => $conn->error]);
    exit;
}

// Bind parameters
$stmt->bind_param("ii", $member_id, $member_id);

// Execute (no arguments allowed)
$stmt->execute();

// Get result
$result = $stmt->get_result();
$data   = $result->fetch_assoc();

echo json_encode([
    "status" => "success",
    "total_pending" => $data["total_pending"] ?? 0
]);

$stmt->close();
$conn->close();
exit;