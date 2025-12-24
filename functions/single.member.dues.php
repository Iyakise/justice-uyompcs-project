<?php
header("Content-Type: application/json");

define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

/* 📥 INPUT */
$member_id = isset($_GET['member_id']) ? (int)$_GET['member_id'] : 0;
$phone     = trim($_GET['phone'] ?? '');

if ($member_id <= 0 || $phone === '') {
    echo json_encode([
        "status" => false,
        "message" => "member_id and phone are required"
    ]);
    exit;
}

/* 🔐 VERIFY MEMBER */
$checkSql = "
    SELECT members_id, name, phone
    FROM mpc_members 
    WHERE members_id = ? AND phone = ?
    LIMIT 1
";

$check = $conn->prepare($checkSql);
if (!$check) {
    echo json_encode([
        "status" => false,
        "message" => "Prepare failed (member): " . $conn->error
    ]);
    exit;
}

$check->bind_param("is", $member_id, $phone);
$check->execute();
$res = $check->get_result();

if ($res->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "Member not found"
    ]);
    exit;
}

$member = $res->fetch_assoc();
$check->close();

/* 💰 FETCH MOST RECENT SPECIAL SAVINGS BALANCE */
$sql_balance = "
    SELECT balance 
    FROM mpc_special_saving
    WHERE mem_id = ?
    ORDER BY special_id DESC
    LIMIT 1
";

$stmt_balance = $conn->prepare($sql_balance);
if (!$stmt_balance) {
    echo json_encode([
        "status" => false,
        "message" => "Prepare failed (special savings): " . $conn->error
    ]);
    exit;
}

$stmt_balance->bind_param("i", $member_id);
$stmt_balance->execute();
$res_balance = $stmt_balance->get_result();

$special_balance = ($res_balance->num_rows > 0) 
    ? (float)$res_balance->fetch_assoc()['balance'] 
    : 0;

$stmt_balance->close();

/* 🔍 FETCH LAST 10 DUES */
$sql_dues = "
    SELECT 
        d.id,
        d.amount,
        d.reason,
        d.created_at,
        CONCAT(u.user_fname, ' ', u.user_lname) AS deducted_by
    FROM mpc_member_dues d
    LEFT JOIN mpc_user u ON u.user_id = d.deducted_by
    WHERE d.member_id = ?
    ORDER BY d.id DESC
    LIMIT 10
";

$stmt_dues = $conn->prepare($sql_dues);
if (!$stmt_dues) {
    echo json_encode([
        "status" => false,
        "message" => "Prepare failed (dues): " . $conn->error
    ]);
    exit;
}

$stmt_dues->bind_param("i", $member_id);
$stmt_dues->execute();
$result_dues = $stmt_dues->get_result();

$dues = [];
while ($row = $result_dues->fetch_assoc()) {
    $dues[] = [
        "amount" => (float)$row['amount'],
        "reason" => $row['reason'],
        "date" => $row['created_at'],
        "deducted_by" => $row['deducted_by'] ?: 'System'
    ];
}

$stmt_dues->close();

/* 💲 FETCH TOTAL SUM OF ALL DUES */
$sql_total = "
    SELECT SUM(amount) AS total_dues
    FROM mpc_member_dues
    WHERE member_id = ?
";
$stmt_total = $conn->prepare($sql_total);
$stmt_total->bind_param("i", $member_id);
$stmt_total->execute();
$res_total = $stmt_total->get_result();
$total_dues = ($res_total->num_rows > 0) ? (float)$res_total->fetch_assoc()['total_dues'] : 0;
$stmt_total->close();

$conn->close();

/* ✅ RESPONSE */
echo json_encode([
    "status" => true,
    "member" => [
        "id" => $member['members_id'],
        "name" => $member['name'],
        "phone" => $member['phone'],
        "special_balance" => $special_balance
    ],
    "recent_dues" => $dues,
    "total_dues" => $total_dues
]);
exit;
