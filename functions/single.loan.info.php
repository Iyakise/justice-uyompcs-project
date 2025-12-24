<?php
header("Content-Type: application/json");
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

$tracking_code = isset($_GET['tracking_code']) ? trim($_GET['tracking_code']) : null;
$debug = isset($_GET['debug']) && $_GET['debug'] == '1';

if (!$tracking_code) {
    echo json_encode(["status" => false, "message" => "Tracking code is required"]);
    exit;
}

/**
 * Helper: prepare, bind, execute and return result or error array
 */
function safe_query($conn, $sql, $types = '', $params = []) {
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return ['error' => $conn->error];
    }
    if ($types !== '') {
        $stmt->bind_param($types, ...$params);
    }
    if (!$stmt->execute()) {
        $err = $stmt->error;
        $stmt->close();
        return ['error' => $err];
    }
    $res = $stmt->get_result();
    $stmt->close();
    return $res;
}

/*******************************
 * 1) CHECK NORMAL LOAN TABLE
 *******************************/
$sql1 = "SELECT *, 'normal' AS loan_type FROM mpc_loans WHERE tracking_code = ? LIMIT 1";
$res1 = safe_query($conn, $sql1, "s", [$tracking_code]);

// if (isset($res1['error'])) {
//     echo json_encode(['status' => false, 'message' => 'SQL error (loans)', 'detail' => $res1['error']]);
//     exit;
// }

if ($res1 && $res1->num_rows > 0) {
    $loanData = $res1->fetch_assoc();
    echo json_encode([
        "status" => true,
        "source" => "normal",
        "data"   => $loanData
    ]);
    exit;
}

/*******************************
 * 2) CHECK SPECIAL LOAN TABLE
 *******************************/
$sql2 = "SELECT *, 'special' AS loan_type FROM mpc_special_loan WHERE tracking_code = ? LIMIT 1";
$res2 = safe_query($conn, $sql2, "s", [$tracking_code]);

// if (isset($res2['error'])) {
//     echo json_encode(['status' => false, 'message' => 'SQL error (special loan)', 'detail' => $res2['error']]);
//     exit;
// }

if (!($res2 && $res2->num_rows > 0)) {
    // nothing found
    echo json_encode(["status" => false, "message" => "No loan found for this tracking code"]);
    exit;
}

$loanData = $res2->fetch_assoc();

// get member id and phone from loan row (defensive)
$member_id = isset($loanData['member_id']) ? intval($loanData['member_id']) : 0;
$member_phone = isset($loanData['members_phone']) ? trim($loanData['members_phone']) : '';

if ($member_id === 0 || $member_phone === '') {
    // Return loan info but warn about missing member id/phone
    echo json_encode([
        "status" => true,
        "source" => "special",
        "data" => $loanData,
        "warning" => "Loan record found but member_id or members_phone missing or invalid",
        "special_savings" => [
            "balance" => 0,
            "debit" => 0,
            "credit" => 0,
            "date_time" => null
        ]
    ]);
    exit;
}

/*******************************************************
 * 3) FETCH MOST RECENT SPECIAL SAVINGS BALANCE FOR MEMBER
 * Use primary key 'special_id' DESC for insertion order.
 *******************************************************/
$sql3 = "SELECT special_id, balance, debit, credit, date_time
         FROM mpc_special_saving
         WHERE mem_id = ? AND mem_phone = ?
         ORDER BY special_id DESC
         LIMIT 1";

$res3 = safe_query($conn, $sql3, "is", [$member_id, $member_phone]);

// if (isset($res3['error'])) {
//     echo json_encode(['status' => false, 'message' => 'SQL error (special saving)', 'detail' => $res3['error']]);
//     exit;
// }

if ($debug) {
    echo json_encode([
        'status' => 'debug',
        'sql' => $sql3,
        'bindings' => [$member_id, $member_phone],
        'found_rows' => ($res3 ? $res3->num_rows : 0)
    ]);
    exit;
}

if ($res3 && $res3->num_rows > 0) {
    $savings = $res3->fetch_assoc();

    // Cast numeric fields
    $savings['balance'] = isset($savings['balance']) ? (float) $savings['balance'] : 0.0;
    $savings['debit']   = isset($savings['debit'])   ? (float) $savings['debit']   : 0.0;
    $savings['credit']  = isset($savings['credit'])  ? (float) $savings['credit']  : 0.0;
    // ensure date_time is present (may be backfilled)
    $savings['date_time'] = isset($savings['date_time']) ? $savings['date_time'] : null;
} else {
    $savings = [
        "balance" => 0.0,
        "debit" => 0.0,
        "credit" => 0.0,
        "date_time" => null
    ];
}

echo json_encode([
    "status" => true,
    "source" => "special",
    "data" => $loanData,
    "special_savings" => $savings
]);
exit;
