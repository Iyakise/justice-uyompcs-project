<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . "/config/conn.php";

header("Content-Type: application/json");

// Allow only POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// Read JSON body
$input = json_decode(file_get_contents("php://input"), true);

$mem_id    = isset($input["mem_id"]) ? intval($input["mem_id"]) : 0;
$mem_phone = isset($input["mem_phone"]) ? trim($input["mem_phone"]) : "";

if ($mem_id === 0 || empty($mem_phone)) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit;
}

try {
    $stmt = $conn->prepare("
        SELECT special_id, mem_id, mem_phone, debit, credit, balance, date_time
        FROM mpc_special_saving
        WHERE mem_id = ? AND mem_phone = ?
        ORDER BY special_id DESC 
        LIMIT 1
    ");

    $stmt->bind_param("is", $mem_id, $mem_phone);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if (!$row) {
        echo json_encode([
            "status" => "error",
            "message" => "No savings record found"
        ]);
        exit;
    }

    // Return the latest record
    echo json_encode([
        "status" => "success",
        "data" => [
            "special_id" => $row["special_id"],
            "mem_id" => $row["mem_id"],
            "mem_phone" => $row["mem_phone"],
            "debit" => (float)$row["debit"],
            "credit" => (float)$row["credit"],
            "balance" => (float)$row["balance"],
            "date_time" => $row["date_time"]
        ]
    ]);

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

$conn->close();
