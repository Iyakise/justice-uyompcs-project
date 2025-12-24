<?php
header("Content-Type: application/json");
define('__mpc_connection__', dirname(__DIR__));
require_once __mpc_connection__ . "/config/conn.php";

// Validate
if (!isset($_GET['phone']) || !isset($_GET['id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "phone and id are required"
    ]);
    exit;
}

$phone = $_GET['phone'];
$id    = $_GET['id'];
$debug = isset($_GET['debug']) && $_GET['debug'] == '1' ? true : false;

/**
 * Get latest balance by ordering on primary key (auto-increment).
 * This avoids problems when date_time contains historical values.
 *
 * @param mysqli $conn
 * @param string $table
 * @param string $pkField   Primary key field name (auto-increment)
 * @param string $idField   Member id field name
 * @param string $phoneField Member phone field name
 * @param mixed  $id
 * @param string $phone
 * @param bool $debug
 * @return float
 */
function getLatestBalanceByPK($conn, $table, $pkField, $idField, $phoneField, $id, $phone, $debug = false)
{
    // whitelist minimal: basic sanity check for identifiers (very small protection)
    $allowedChars = '/^[a-zA-Z0-9_]+$/';
    foreach ([$table, $pkField, $idField, $phoneField] as $ident) {
        if (!preg_match($allowedChars, $ident)) {
            if ($debug) {
                return 0; // invalid identifier
            }
            return 0;
        }
    }

    $sql = "SELECT balance FROM `$table`
            WHERE `$idField` = ? AND `$phoneField` = ?
            ORDER BY `$pkField` DESC
            LIMIT 1";

    if ($debug) {
        // For debugging only: return the SQL that would run and the bound values
        return [
            'sql' => $sql,
            'bindings' => [$id, $phone]
        ];
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return 0;
    }

    // assume id is integer-like; phone is string
    // detect id type
    $idType = is_int($id) || ctype_digit((string)$id) ? "i" : "s";
    $stmt->bind_param($idType . "s", $id, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        return (float)$row['balance'];
    }
    return 0;
}

// Map tables to their primary key and id/phone columns
$tables = [
    'shares' => [
        'table' => 'mpc_account_shares',
        'pk'    => 'shares_id',
        'id'    => 'shares_member_id',
        'phone' => 'shares_member_phone'
    ],
    'thrift' => [
        'table' => 'mpc_thrift_saving',
        'pk'    => 'thrift_id',
        'id'    => 'thrift_mem_id',
        'phone' => 'thrift_mem_phone'
    ],
    'special' => [
        'table' => 'mpc_special_saving',
        'pk'    => 'special_id',
        'id'    => 'mem_id',
        'phone' => 'mem_phone'
    ]
];

// Fetch balances
$shares_balance = getLatestBalanceByPK(
    $conn,
    $tables['shares']['table'],
    $tables['shares']['pk'],
    $tables['shares']['id'],
    $tables['shares']['phone'],
    $id,
    $phone,
    $debug
);

$thrift_balance = getLatestBalanceByPK(
    $conn,
    $tables['thrift']['table'],
    $tables['thrift']['pk'],
    $tables['thrift']['id'],
    $tables['thrift']['phone'],
    $id,
    $phone,
    $debug
);

$special_balance = getLatestBalanceByPK(
    $conn,
    $tables['special']['table'],
    $tables['special']['pk'],
    $tables['special']['id'],
    $tables['special']['phone'],
    $id,
    $phone,
    $debug
);

// If debug, return the SQL/snippets for each table instead of numeric balances
if ($debug) {
    echo json_encode([
        'status' => 'debug',
        'shares'  => $shares_balance,
        'thrift'  => $thrift_balance,
        'special' => $special_balance
    ]);
    exit;
}

$total_balance = $shares_balance + $thrift_balance + $special_balance;
$loan_limit = $total_balance * 3;

echo json_encode([
    "status" => "success",
    "shares_balance"  => $shares_balance,
    "thrift_balance"  => $thrift_balance,
    "special_balance" => $special_balance,
    "total_balance"   => $total_balance,
    "loan_limit"      => $loan_limit
]);
exit;
