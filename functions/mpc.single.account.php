<?php
header("Content-Type: application/json");
define("__mpc_connection__", dirname(__DIR__));
require __mpc_connection__ . "/config/conn.php";

$member_id = $_REQUEST['member_id'] ?? null;
$member_phone = $_REQUEST['member_phone'] ?? null;

if (!$member_id || !$member_phone) {
    echo json_encode([
        "status" => false,
        "message" => "member_id and member_phone are required"
    ]);
    exit;
}

function getBalance($conn, $table, $id_col, $phone_col, $order_col) {
    $sql = "SELECT balance FROM $table 
            WHERE $id_col = ? AND $phone_col = ? 
            ORDER BY $order_col DESC LIMIT 1";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $GLOBALS['member_id'], $GLOBALS['member_phone']);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) return 0;

    return $result->fetch_assoc()['balance'] ?? 0;
}

/***************************************
 * GET BALANCES FROM ALL THREE TABLES
 ***************************************/

$special_balance = getBalance($conn, "mpc_special_saving", "mem_id", "mem_phone", "special_id");
$thrift_balance = getBalance($conn, "mpc_thrift_saving", "thrift_mem_id", "thrift_mem_phone", "thrift_id");
$shares_balance = getBalance($conn, "mpc_account_shares", "shares_member_id", "shares_member_phone", "shares_id");

echo json_encode([
    "status" => true,
    "message" => "Balances fetched successfully",
    "data" => [
        "special_saving_balance" => floatval($special_balance),
        "thrift_saving_balance"  => floatval($thrift_balance),
        "shares_balance"         => floatval($shares_balance)
    ]
]);
exit;
?>
