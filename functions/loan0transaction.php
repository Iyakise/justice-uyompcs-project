<?php
define('__mpc_connection__', dirname(__DIR__));
require_once __mpc_connection__ . "/config/conn.php"; // database connection

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Get JSON input or fallback to form data
$input = json_decode(file_get_contents("php://input"), true);

$member_id    = isset($input['member_id']) ? intval($input['member_id']) : (isset($_POST['member_id']) ? intval($_POST['member_id']) : 0);
$member_phone = isset($input['member_phone']) ? trim($input['member_phone']) : (isset($_POST['member_phone']) ? trim($_POST['member_phone']) : '');

if ($member_id === 0 || empty($member_phone)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

try {
    // 1️⃣ Sum debit and credit only
    $stmt = $conn->prepare("
        SELECT 
            COALESCE(SUM(debit), 0) AS total_debit,
            COALESCE(SUM(credit), 0) AS total_credit
        FROM mpc_load_transaction
        WHERE members_id = ? AND members_phone = ?
    ");
    $stmt->bind_param("is", $member_id, $member_phone);
    $stmt->execute();
    $sum_result = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    // 2️⃣ Get latest balance and last transaction date
    $stmt2 = $conn->prepare("
        SELECT balance, trans_date 
        FROM mpc_load_transaction 
        WHERE members_id = ? AND members_phone = ?
        ORDER BY id DESC LIMIT 1
    ");
    $stmt2->bind_param("is", $member_id, $member_phone);
    $stmt2->execute();
    $last_row = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();

    $last_balance = $last_row ? (float)$last_row['balance'] : 0;
    $last_transaction = $last_row ? $last_row['trans_date'] : null;

    // ✅ Final response
    echo json_encode([
        'status' => 'success',
        'data' => [
            'member_id' => $member_id,
            'member_phone' => $member_phone,
            'total_debit' => (float)$sum_result['total_debit'],
            'total_credit' => (float)$sum_result['total_credit'],
            'current_balance' => $last_balance, // ✅ only latest balance
            'last_transaction' => $last_transaction
        ]
    ]);

    $conn->close();

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
