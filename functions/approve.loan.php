<?php
header("Content-Type: application/json");
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

try {
    // Prepare SQL query to get approved or active loans with member info
    $sql = "
        SELECT 
            l.id AS loan_id,
            l.tracking_code,
            l.member_id,
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
            l.updated_at,
            m.name,
           
            m.email
        FROM mpc_loans l
        INNER JOIN mpc_members m ON l.member_id = m.member_id
        WHERE l.status IN ('approved', 'active')
        ORDER BY l.created_at DESC
    ";

    $result = $conn->query($sql);

    $loans = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $loans[] = $row;
        }
    }

    echo json_encode([
        "status" => true,
        "data" => $loans
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ]);
}

$conn->close();
?>
