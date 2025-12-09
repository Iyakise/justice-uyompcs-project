<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

header("Content-Type: application/json");

// Query 1: Normal Loans (Only Pending)
$normalQuery = "
    SELECT 
        l.id,
        l.tracking_code,
        l.member_id,
        m.name AS member_name,
        l.members_phone,
        l.loan_amount,
        l.interest_rate,
        l.total_payable,
        l.duration_months,
        l.monthly_payment,
        l.status,
        l.repayment_frequency,
        l.approved_by,
        l.issued_at,
        l.due_date,
        l.created_at,
        'normal' AS loan_type
    FROM mpc_loans l
    LEFT JOIN mpc_members m ON l.member_id = m.members_id
    WHERE l.status = 'pending'
    ORDER BY l.created_at DESC
";

$normalResult = $conn->query($normalQuery);

if (!$normalResult) {
    echo json_encode(["status" => "error", "message" => $conn->error]);
    exit;
}

$normalLoans = [];
while ($row = $normalResult->fetch_assoc()) {
    $normalLoans[] = $row;
}

// Query 2: Special Loans (Only Pending)
$specialQuery = "
    SELECT 
        s.id,
        s.tracking_code,
        s.member_id,
        m.name AS member_name,
        s.members_phone,
        s.loan_amount,
        0 AS interest_rate,
        s.loan_amount AS total_payable,
        NULL AS duration_months,
        NULL AS monthly_payment,
        s.status,
        NULL AS repayment_frequency,
        s.approved_by,
        NULL AS issued_at,
        NULL AS due_date,
        s.created_at,
        'special' AS loan_type,
        s.loan_reason
    FROM mpc_special_loan s
    LEFT JOIN mpc_members m ON s.member_id = m.members_id
    WHERE s.status = 'pending'
    ORDER BY s.created_at DESC
";

$specialResult = $conn->query($specialQuery);

if (!$specialResult) {
    echo json_encode(["status" => "error", "message" => $conn->error]);
    exit;
}

$specialLoans = [];
while ($row = $specialResult->fetch_assoc()) {
    $specialLoans[] = $row;
}

// Merge both tables
$allLoans = array_merge($normalLoans, $specialLoans);

// Sort newest first
usort($allLoans, function ($a, $b) {
    return strtotime($b['created_at']) - strtotime($a['created_at']);
});

// Return JSON
echo json_encode([
    "status" => "success",
    "total" => count($allLoans),
    "loans" => $allLoans
]);
exit;
