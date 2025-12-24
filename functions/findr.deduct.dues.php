<?php
session_start();
header("Content-Type: application/json");

define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . "/config/conn.php";

/* 🔐 ADMIN ONLY */
if (!isset($_SESSION['MPC_ADMIN_LOGIN_ID_AS'])) {
    echo json_encode([
        "status" => false,
        "message" => "Unauthorized access"
    ]);
    exit;
}

/* 📥 INPUT */
$input = json_decode(file_get_contents("php://input"), true);
$member_id = (int)($input['member_id'] ?? 0);
$member_phone = trim($input['member_phone'] ?? '');
$amount = (float)($input['amount'] ?? 0);
$reason = trim($input['reason'] ?? '');

if ($member_id <= 0 || $amount <= 0) {
    echo json_encode([
        "status" => false,
        "message" => "Member ID and valid amount are required"
    ]);
    exit;
}

/* 🟢 START TRANSACTION */
$conn->begin_transaction();

try {
    /* 1️⃣ GET CURRENT SPECIAL SAVINGS BALANCE */
    $sql_balance = "SELECT balance FROM mpc_special_saving WHERE mem_id = ? ORDER BY special_id DESC LIMIT 1";
    $stmt_balance = $conn->prepare($sql_balance);
    $stmt_balance->bind_param("i", $member_id);
    $stmt_balance->execute();
    $result_balance = $stmt_balance->get_result();
    $current_balance = ($result_balance->num_rows > 0) ? (float)$result_balance->fetch_assoc()['balance'] : 0;
    $stmt_balance->close();

    /* 2️⃣ CHECK IF ENOUGH BALANCE */
    if ($current_balance < $amount) {
        $conn->rollback();
        echo json_encode([
            "status" => false,
            "message" => "Insufficient balance for this deduction"
        ]);
        exit;
    }

    $new_balance = $current_balance - $amount;

    /* 3️⃣ UPDATE SPECIAL SAVINGS TABLE */
    $sql_update = "INSERT INTO mpc_special_saving (mem_id, mem_phone, debit, credit, balance, date_time)
                   VALUES (?, ?, ?, 0, ?, NOW())";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("isdd", $member_id, $member_phone, $amount, $new_balance);
    $stmt_update->execute();
    $stmt_update->close();

    /* 4️⃣ RECORD DUES */
    $sql_dues = "INSERT INTO mpc_member_dues (member_id, member_phone, amount, reason, deducted_by) VALUES (?, ?, ?, ?, ?)";
    $stmt_dues = $conn->prepare($sql_dues);
    $admin_id = $_SESSION['MPC_ADMIN_LOGIN_ID_AS'];
    $stmt_dues->bind_param("isdsi", $member_id, $member_phone, $amount, $reason, $admin_id);
    $stmt_dues->execute();
    $stmt_dues->close();

    /* ✅ COMMIT TRANSACTION */
    $conn->commit();

    echo json_encode([
        "status" => true,
        "message" => "Dues deducted successfully",
        "remaining_balance" => $new_balance
    ]);

} catch (Exception $e) {
    $conn->rollback();
    echo json_encode([
        "status" => false,
        "message" => "Failed to deduct dues",
        "error" => $e->getMessage()
    ]);
}

$conn->close();
exit;
