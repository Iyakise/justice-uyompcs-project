<?php
define('__mpc_connection__', dirname(__DIR__));
require_once __mpc_connection__ . "/config/conn.php"; // mysqli connection

header('Content-Type: application/json');

// Allow only POST method (following your format)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

try {

    // 1️⃣ Count unique members across all tables
    $sql = "
        SELECT COUNT(*) AS total_unique FROM (
            SELECT shares_member_id AS id, shares_member_phone AS phone FROM mpc_account_shares
            UNION
            SELECT thrift_mem_id AS id, thrift_mem_phone AS phone FROM mpc_thrift_saving
            UNION
            SELECT mem_id AS id, mem_phone AS phone FROM mpc_special_saving
        ) AS all_members
    ";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }

    $row = $result->fetch_assoc();
    $total_unique = intval($row['total_unique']);

    // 2️⃣ Return success JSON
    echo json_encode([
        'status' => 'success',
        'data' => [
            'total_unique_members' => $total_unique
        ]
    ]);

    $conn->close();

} catch (Exception $e) {

    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>
