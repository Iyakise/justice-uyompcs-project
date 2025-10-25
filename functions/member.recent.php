<?php
define('__mpc_connection__', dirname(__DIR__));
require_once __mpc_connection__ . "/config/conn.php";

header('Content-Type: application/json');

// ✅ Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// ✅ Get input data (JSON or Form)
$input = json_decode(file_get_contents("php://input"), true);
$member_id = isset($input['member_id']) ? intval($input['member_id']) : (isset($_POST['member_id']) ? intval($_POST['member_id']) : 0);
$member_phone = isset($input['member_phone']) ? trim($input['member_phone']) : (isset($_POST['member_phone']) ? trim($_POST['member_phone']) : '');

if ($member_id === 0 || empty($member_phone)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// ✅ Helper function to fetch transactions
function fetchTransactions($conn, $table, $id_col, $phone_col, $limit = 5) {
    $sql = "SELECT debit, credit, balance, date_time 
            FROM $table 
            WHERE $id_col = ? AND $phone_col = ?
            ORDER BY date_time DESC
            LIMIT ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ['error' => $conn->error];
    }

    $stmt->bind_param("isi", $GLOBALS['member_id'], $GLOBALS['member_phone'], $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            'debit' => (float)$row['debit'],
            'credit' => (float)$row['credit'],
            'balance' => (float)$row['balance'],
            'date_time' => $row['date_time']
        ];
    }
    $stmt->close();

    return $data;
}

try {
    // ✅ Fetch recent 5 from each table
    $shares = fetchTransactions($conn, 'mpc_account_shares', 'shares_member_id', 'shares_member_phone', 5);
    $thrift = fetchTransactions($conn, 'mpc_thrift_saving', 'thrift_mem_id', 'thrift_mem_phone', 5);
    $special = fetchTransactions($conn, 'mpc_special_saving', 'mem_id', 'mem_phone', 5);

    // ✅ If any table had an SQL error
    if (isset($shares['error']) || isset($thrift['error']) || isset($special['error'])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'SQL error occurred',
            'details' => [
                'shares' => $shares['error'] ?? null,
                'thrift' => $thrift['error'] ?? null,
                'special' => $special['error'] ?? null,
            ]
        ]);
        exit;
    }

    echo json_encode([
        'status' => 'success',
        'member_id' => $member_id,
        'member_phone' => $member_phone,
        'recent_transactions' => [
            'shares' => $shares,
            'thrift' => $thrift,
            'special' => $special
        ]
    ]);

    $conn->close();

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
