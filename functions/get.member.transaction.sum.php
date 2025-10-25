<?php
define('__mpc_connection__', dirname(__DIR__));
require_once __mpc_connection__ . "/config/conn.php";

header('Content-Type: application/json');

// ✅ Only allow POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// ✅ Read JSON or form data
$input = json_decode(file_get_contents("php://input"), true);
$member_id = isset($input['member_id']) ? intval($input['member_id']) : (isset($_POST['member_id']) ? intval($_POST['member_id']) : 0);
$member_phone = isset($input['member_phone']) ? trim($input['member_phone']) : (isset($_POST['member_phone']) ? trim($_POST['member_phone']) : '');

if ($member_id === 0 || empty($member_phone)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

try {
    // ✅ Fetch recent 25 transactions for this member
    $sql = "
    SELECT 
        id,
        members_id,
        members_phone,
        debit,
        credit,
        balance,
        trans_date
    FROM mpc_load_transaction
    WHERE members_id = ? AND members_phone = ?
    ORDER BY id DESC
    LIMIT 25
";

$stmt = $conn->prepare($sql);

// ✅ Debug if prepare failed
if (!$stmt) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Prepare failed: ' . $conn->error,
        'query' => $sql
    ]);
    exit;
}


    $stmt->bind_param("is", $member_id, $member_phone);
    $stmt->execute();
    $result = $stmt->get_result();

    $transactions = [];
    $total_debit = 0;
    $total_credit = 0;
    $latest_balance = 0;
    $last_transaction_date = null;

$first_balance_set = false;

while ($row = $result->fetch_assoc()) {
    $transactions[] = [
        'id' => $row['id'],
        'debit' => (float)$row['debit'],
        'credit' => (float)$row['credit'],
        'balance' => (float)$row['balance'],
        'trans_date' => $row['trans_date']
    ];

    $total_debit += (float)$row['debit'];
    $total_credit += (float)$row['credit'];

    // ✅ Capture the first (most recent) balance only
    if (!$first_balance_set) {
        $latest_balance = (float)$row['balance'];
        $first_balance_set = true;
    }

    // ✅ Capture the most recent transaction date (first one)
    if (!$last_transaction_date) $last_transaction_date = $row['trans_date'];
}


    echo json_encode([
        'status' => 'success',
        'member_id' => $member_id,
        'member_phone' => $member_phone,
        'total_debit' => $total_debit,
        'total_credit' => $total_credit,
        'current_balance' => $latest_balance,
        'last_transaction' => $last_transaction_date,
        'count' => count($transactions),
        'data' => $transactions
    ]);

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
