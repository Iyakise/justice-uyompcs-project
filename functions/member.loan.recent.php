<?php
define('__mpc_connection__', dirname(__DIR__));
require_once __mpc_connection__ . "/config/conn.php"; // your MySQLi connection

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Read JSON body or fallback to $_POST
$input = json_decode(file_get_contents("php://input"), true);
$member_id    = isset($input['member_id']) ? intval($input['member_id']) : (isset($_POST['member_id']) ? intval($_POST['member_id']) : 0);
$member_phone = isset($input['member_phone']) ? trim($input['member_phone']) : (isset($_POST['member_phone']) ? trim($_POST['member_phone']) : '');

if ($member_id === 0 || empty($member_phone)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

try {
    $stmt = $conn->prepare("
        SELECT id, debit, credit, balance, trans_date 
        FROM mpc_load_transaction 
        WHERE members_id = ? AND members_phone = ?
        ORDER BY id DESC 
        LIMIT 10
    ");
    $stmt->bind_param("is", $member_id, $member_phone);
    $stmt->execute();
    $result = $stmt->get_result();

    $transactions = [];
    while ($row = $result->fetch_assoc()) {
        $transactions[] = [
            'id' => (int)$row['id'],
            'debit' => (float)$row['debit'],
            'credit' => (float)$row['credit'],
            'balance' => (float)$row['balance'],
            'trans_date' => $row['trans_date']
        ];
    }

    $stmt->close();
    $conn->close();

    echo json_encode([
        'status' => 'success',
        'count' => count($transactions),
        'data' => $transactions
    ]);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
