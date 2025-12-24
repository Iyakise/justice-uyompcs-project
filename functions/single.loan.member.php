<?php
header("Content-Type: application/json");

define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

/* 📥 INPUT */
$member_id = $_GET['id'] ?? '';
$phone     = $_GET['phone'] ?? '';

if ($member_id === '' || $phone === '') {
    echo json_encode([
        "status" => false,
        "message" => "member_id and phone are required"
    ]);
    exit;
}

/* 🔍 FETCH ACTIVE LOAN */
$sql = "
    SELECT 
        id,
        tracking_code,
        loan_amount,
        total_payable,
        amount_paid,
        status
    FROM mpc_loans
    WHERE member_id = ?
      AND members_phone = ?
      AND status = 'approved'
    LIMIT 1
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $member_id, $phone);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "No active loan found for this member"
    ]);
    exit;
}

$loan = $result->fetch_assoc();

/* ✅ RESPONSE */
echo json_encode([
    "status" => true,
    "member_id" => (int)$member_id,
    "phone" => $phone,
    "tracking_code" => $loan['tracking_code'],
    "loan_amount" => (float)$loan['loan_amount'],
    "amount_paid" => (float)$loan['amount_paid'],
    "current_balance" => (float)$loan['total_payable'],
    "loan_status" => $loan['status']
]);

$stmt->close();
$conn->close();
exit;
