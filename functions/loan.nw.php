<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

header("Content-Type: application/json");

try {
    // Count of active loans (status = approved OR active)
    $sqlActive = "SELECT COUNT(*) AS active_loans FROM mpc_loans WHERE status IN ('approved','active')";
    $resActive = $conn->query($sqlActive);
    $activeLoans = $resActive->fetch_assoc()['active_loans'] ?? 0;

    // Total loans in the table
    $sqlTotal = "SELECT COUNT(*) AS total_loans FROM mpc_loans";
    $resTotal = $conn->query($sqlTotal);
    $totalLoans = $resTotal->fetch_assoc()['total_loans'] ?? 0;

    // Return JSON
    echo json_encode([
        "status" => "success",
        "data" => [
            "active_loans" => intval($activeLoans),
            "total_loans" => intval($totalLoans)
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}

$conn->close();
