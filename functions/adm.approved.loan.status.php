<?php
header("Content-Type: application/json");
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';
$input = json_decode(file_get_contents("php://input"), true);
$response = [];

$tracking_code = $input['tracking_code'] ?? null;
$approved_by   = $input['approved_by'] ?? null;

if (!$tracking_code || !$approved_by) {
    echo json_encode([
        "status" => false,
        "message" => "tracking_code and approved_by are required"
    ]);
    exit;
}

/***********************************************
 * 1. CHECK SPECIAL LOAN FIRST
 ***********************************************/
$sql_s = "SELECT * FROM mpc_special_loan WHERE tracking_code = ?";
$stmt_s = $conn->prepare($sql_s);
$stmt_s->bind_param("s", $tracking_code);
$stmt_s->execute();
$res_s = $stmt_s->get_result();

if ($res_s->num_rows > 0) {

    $loan = $res_s->fetch_assoc();

    if ($loan['status'] === "approved") {
        echo json_encode(["status" => false, "message" => "Loan already approved"]);
        exit;
    }

    $member_id    = $loan['member_id'];
    $member_phone = $loan['members_phone'];
    $loan_amount  = $loan['loan_amount'];

    /***********************************************
     * GET MEMBER SPECIAL SAVINGS BALANCE
     ***********************************************/
    $bal_query = "
        SELECT balance 
        FROM mpc_special_saving 
        WHERE mem_id = ? AND mem_phone = ?
        ORDER BY mem_id DESC LIMIT 1
    ";

    $stmt_bal = $conn->prepare($bal_query);
    $stmt_bal->bind_param("is", $member_id, $member_phone);
    $stmt_bal->execute();
    $bal_res = $stmt_bal->get_result();

    if ($bal_res->num_rows == 0) {
        echo json_encode(["status" => false, "message" => "Member has no savings record"]);
        exit;
    }

    $current_balance = $bal_res->fetch_assoc()['balance'];

    if ($current_balance < $loan_amount) {
        echo json_encode(["status" => false, "message" => "Insufficient balance"]);
        exit;
    }

    $new_balance = $current_balance - $loan_amount;

    /***********************************************
     * INSERT DEDUCTION INTO SPECIAL SAVING
     ***********************************************/
    $insert_save = "
        INSERT INTO mpc_special_saving (mem_id, mem_phone, debit, credit, balance, date_time)
        VALUES (?, ?, ?, 0, ?, NOW())
    ";

    $stmt_insert = $conn->prepare($insert_save);
    $stmt_insert->bind_param("isdd", $member_id, $member_phone, $loan_amount, $new_balance);
    $stmt_insert->execute();

    /***********************************************
     * UPDATE SPECIAL LOAN STATUS
     ***********************************************/
    $update_sql = "UPDATE mpc_special_loan SET status='approved', approved_by=?, updated_at=NOW() WHERE id=?";
    $stmt_up = $conn->prepare($update_sql);
    $stmt_up->bind_param("si", $approved_by, $loan['id']);
    $stmt_up->execute();

    echo json_encode([
        "status" => true,
        "loan_type" => "special",
        "message" => "Special loan approved successfully",
        "new_balance" => $new_balance
    ]);
    exit;
}


/***********************************************
 * 2. CHECK NORMAL LOAN
 ***********************************************/
$sql_n = "SELECT * FROM mpc_loans WHERE tracking_code = ?";
$stmt_n = $conn->prepare($sql_n);
$stmt_n->bind_param("s", $tracking_code);
$stmt_n->execute();
$res_n = $stmt_n->get_result();

if ($res_n->num_rows > 0) {

    $loan = $res_n->fetch_assoc();

    if ($loan['status'] === "approved") {
        echo json_encode(["status" => false, "message" => "Loan already approved"]);
        exit;
    }

    /***********************************************
     * UPDATE NORMAL LOAN
     ***********************************************/
    $update = "UPDATE mpc_loans SET status='approved', approved_by=?, updated_at=NOW() WHERE id=?";
    $stmt_u = $conn->prepare($update);
    $stmt_u->bind_param("si", $approved_by, $loan['id']);
    $stmt_u->execute();

    echo json_encode([
        "status" => true,
        "loan_type" => "normal",
        "message" => "Normal loan approved successfully"
    ]);
    exit;
}


/***********************************************
 * 3. NOT FOUND
 ***********************************************/
echo json_encode([
    "status" => false,
    "message" => "Loan not found"
]);
exit;
