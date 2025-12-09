<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

header("Content-Type: application/json");

// Query ONLY Normal Loans
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
    ORDER BY l.created_at DESC
";

$result = $conn->query($normalQuery);

if (!$result) {
    echo json_encode([
        "status" => "error",
        "message" => $conn->error
    ]);
    exit;
}

$loans = [];
while ($row = $result->fetch_assoc()) {
    $loans[] = $row;
}

// Return JSON
echo json_encode([
    "status" => "success",
    "total" => count($loans),
    "loans" => $loans
]);
exit;
