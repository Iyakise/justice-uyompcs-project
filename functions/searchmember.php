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
$query = trim($input['query'] ?? '');

if ($query === '') {
    echo json_encode([
        "status" => false,
        "message" => "Search query is required"
    ]);
    exit;
}

/* 🔍 SEARCH MEMBER */
$sql = "
    SELECT 
        m.members_id,
        m.name,
        m.phone,
        m.email,
        m.registration_number
    FROM mpc_members m
    WHERE 
        (m.members_id = ?)
        OR (m.phone LIKE ?)
        OR (m.name LIKE ?)
    LIMIT 1
";

$stmt = $conn->prepare($sql);
$like = "%{$query}%";
$id = is_numeric($query) ? (int)$query : 0;

$stmt->bind_param("iss", $id, $like, $like);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "No member found"
    ]);
    exit;
}

$member = $result->fetch_assoc();
$member_id = $member['members_id'];

/* 🔢 FETCH 10 MOST RECENT DUES + ADMIN NAME */
$sql_dues = "
    SELECT 
        d.amount,
        d.reason,
        d.created_at,
        d.deducted_by,
        CONCAT(u.user_fname, ' ', u.user_lname) AS admin_name
    FROM mpc_member_dues d
    LEFT JOIN mpc_user u ON u.user_id = d.deducted_by
    WHERE d.member_id = ?
    ORDER BY d.created_at DESC
    LIMIT 10
";

$stmt_dues = $conn->prepare($sql_dues);
$stmt_dues->bind_param("i", $member_id);
$stmt_dues->execute();
$result_dues = $stmt_dues->get_result();

$dues = [];
while ($row = $result_dues->fetch_assoc()) {
    $dues[] = $row;
}

$stmt_dues->close();

/* 💰 FETCH MOST RECENT SPECIAL SAVINGS BALANCE */
$sql_balance = "
    SELECT balance 
    FROM mpc_special_saving
    WHERE mem_id = ?
    ORDER BY date_time DESC
    LIMIT 1
";

$stmt_balance = $conn->prepare($sql_balance);
$stmt_balance->bind_param("i", $member_id);
$stmt_balance->execute();
$result_balance = $stmt_balance->get_result();

if ($result_balance->num_rows > 0) {
    $special_balance = $result_balance->fetch_assoc()['balance'];
} else {
    $special_balance = 0;
}

$stmt_balance->close();
$stmt->close();

echo json_encode([
    "status" => true,
    "member" => $member,
    "recent_dues" => $dues,
    "special_balance" => (float)$special_balance
]);
exit;
?>