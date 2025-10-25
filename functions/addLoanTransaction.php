<?php
define('__mpc_connection__', dirname(__DIR__));
require_once __mpc_connection__ . "/config/conn.php"; // database connection

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

// Get raw input (in case it's sent as JSON)
$input = json_decode(file_get_contents("php://input"), true);

// Support both JSON and form-data
$member_id    = isset($input['member_id']) ? intval($input['member_id']) : (isset($_POST['member_id']) ? intval($_POST['member_id']) : 0);
$member_phone = isset($input['member_phone']) ? trim($input['member_phone']) : (isset($_POST['member_phone']) ? trim($_POST['member_phone']) : '');
$debit        = isset($input['debit']) ? floatval($input['debit']) : (isset($_POST['debit']) ? floatval($_POST['debit']) : 0);
$credit       = isset($input['credit']) ? floatval($input['credit']) : (isset($_POST['credit']) ? floatval($_POST['credit']) : 0);
$balance      = isset($input['balance']) ? floatval($input['balance']) : (isset($_POST['balance']) ? floatval($_POST['balance']) : 0);
$date         = isset($input['date']) ? trim($input['date']) : (isset($_POST['date']) ? trim($_POST['date']) : '');
$description  = isset($input['description']) ? trim($input['description']) : (isset($_POST['description']) ? trim($_POST['description']) : '');

// Validate required fields
// echo json_encode([
//     'status' => 'false',
//     'message'=> $member_id . ' ||| ' . $member_phone
// ]);

// die;
if ($member_id === 0 || empty($member_phone) || empty($date)) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit;
}

// Prepare and insert into DB
try {
    $stmt = $conn->prepare("
        INSERT INTO mpc_load_transaction 
        (members_id, members_phone, debit, credit, balance, trans_date, description) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        throw new Exception("Database prepare failed: " . $conn->error);
    }

    $stmt->bind_param("isddsss", $member_id, $member_phone, $debit, $credit, $balance, $date, $description);

    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Transaction saved successfully',
            'data' => [
                'id' => $stmt->insert_id,
                'member_id' => $member_id,
                'member_phone' => $member_phone,
                'debit' => $debit,
                'credit' => $credit,
                'balance' => $balance,
                'date' => $date,
                'description' => $description
            ]
        ]);
    } else {
        throw new Exception("Database insert failed: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>
