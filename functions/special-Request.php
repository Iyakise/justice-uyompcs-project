<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

header("Content-Type: application/json");

// Allow only POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// Read JSON input
$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
    exit;
}

// Required fields
$required_fields = ["member_id", "members_phone", "loan_amount", "loan_reason"];

foreach ($required_fields as $field) {
    if (!isset($input[$field]) || $input[$field] === "") {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required field: $field"
        ]);
        exit;
    }
}

// Assign values
$member_id      = intval($input["member_id"]);
$members_phone  = trim($input["members_phone"]);
$loan_amount    = floatval($input["loan_amount"]);
$loan_reason    = trim($input["loan_reason"]);

$status         = "pending"; // Default
$approved_by    = null;
$created_at     = date("Y-m-d H:i:s");
$updated_at     = date("Y-m-d H:i:s");

// Generate unique tracking code
$tracking_code = 'SPC' . strtoupper(substr(uniqid(), -8));

try {

    $stmt = $conn->prepare("
        INSERT INTO mpc_special_loan 
        (member_id, members_phone, loan_amount, loan_reason, tracking_code, status, approved_by, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        throw new Exception("SQL Error: " . $conn->error);
    }

    $stmt->bind_param(
        "isdssssss",
        $member_id,
        $members_phone,
        $loan_amount,
        $loan_reason,
        $tracking_code,
        $status,
        $approved_by,
        $created_at,
        $updated_at
    );

    $exec = $stmt->execute();

    if ($exec) {
        echo json_encode([
            "status" => "success",
            "message" => "Special loan request submitted successfully",
            "loan_id" => $stmt->insert_id,
            "tracking_code" => $tracking_code
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to save loan request: " . $stmt->error
        ]);
    }

    $stmt->close();

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

$conn->close();
