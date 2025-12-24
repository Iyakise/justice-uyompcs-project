<?php
header("Content-Type: application/json");
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

try {

    $data = json_decode(file_get_contents("php://input"), true);

    $tracking   = $data['tracking_code'] ?? '';
    $amount     = $data['repayment_amount'] ?? 0;
    $method     = $data['payment_method'] ?? '';
    $reference  = $data['payment_reference'] ?? '';
    $notes      = $data['notes'] ?? '';

    if (!$tracking || $amount <= 0) {
        throw new Exception("Tracking code and repayment amount are required");
    }

    /** 1. Fetch loan ONLY from mpc_loans */
    $sql = "SELECT * FROM mpc_loans WHERE tracking_code = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("SQL Prepare Error: " . $conn->error);
    }

    $stmt->bind_param("s", $tracking);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        throw new Exception("No loan found");
    }

    $loan = $res->fetch_assoc();

    /** 2. Compute interest + principal split */
    $old_balance = $loan['total_payable'];

    // Monthly interest = monthly_payment − (principal_per_month)
    $principal_per_month = ($loan['loan_amount'] / $loan['duration_months']);
    $expected_monthly_interest = $loan['monthly_payment'] - $principal_per_month;

    // Ensure interest is not negative
    $expected_monthly_interest = max($expected_monthly_interest, 0);

    // Pay interest first
    $interest_paid = min($amount, $expected_monthly_interest);
    $principal_paid = $amount - $interest_paid;

    // $new_balance = $old_balance - $principal_paid;
    $old_balance = $loan['total_payable'];

/* Interest / principal split stays for record */
$principal_per_month = ($loan['loan_amount'] / $loan['duration_months']);
$expected_monthly_interest = $loan['monthly_payment'] - $principal_per_month;
$expected_monthly_interest = max($expected_monthly_interest, 0);

$interest_paid  = min($amount, $expected_monthly_interest);
$principal_paid = $amount - $interest_paid;

/* ✅ FIX: balance reduces by FULL payment */
$new_balance = $old_balance - $amount;


    /** 3. Insert repayment record */
    $insert = $conn->prepare("
        INSERT INTO mpc_repayments 
        (loan_table, loan_id, tracking_code, member_id, member_phone, repayment_amount, principal_paid, interest_paid, old_balance, new_balance, payment_method, payment_reference, notes) 
        VALUES ('mpc_loans', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$insert) {
        throw new Exception("Insert Prepare Error: " . $conn->error);
    }

    $insert->bind_param(
        "isissddsdsss",
        $loan['id'],
        $tracking,
        $loan['member_id'],
        $loan['members_phone'],
        $amount,
        $principal_paid,
        $interest_paid,
        $old_balance,
        $new_balance,
        $method,
        $reference,
        $notes
    );

    $insert->execute();

    /** 4. Update loan balance */
    /** 4. Update loan balance and amount_paid */
    $update = $conn->prepare("UPDATE mpc_loans SET total_payable = ?, amount_paid = amount_paid + ? WHERE id = ?");
    if (!$update) {
        throw new Exception("Update Prepare Error: " . $conn->error);
    }

    $update->bind_param("ddi", $new_balance, $amount, $loan['id']);
    $update->execute();


    echo json_encode([
        "status" => true,
        "error"  => false,
        "message" => "Repayment recorded successfully",
        "old_balance" => $old_balance,
        "new_balance" => $new_balance,
        "principal_paid" => $principal_paid,
        "interest_paid" => $interest_paid,
        "company_earning" => $interest_paid
    ]);

} catch (Exception $e) {

    echo json_encode([
        "status" => false,
        "error"  => true,
        "message" => $e->getMessage()
    ]);
}

?>
