<?php
header("Content-Type: application/json");
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

$response = [];
$tracking_code = $_GET['tracking_code'] ?? null;

if (!$tracking_code) {
    echo json_encode(["status" => false, "message" => "Tracking code is required"]);
    exit;
}

/** -------------------------------------------
 *  1. CHECK NORMAL LOAN TABLE (NO SAVINGS NEEDED)
 * ------------------------------------------*/
$sql1 = "SELECT *, 'normal' AS loan_type FROM mpc_loans WHERE tracking_code = ?";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $tracking_code);
$stmt1->execute();
$result1 = $stmt1->get_result();

if ($result1->num_rows > 0) {
    echo json_encode([
        "status" => true,
        "source" => "normal",
        "data"   => $result1->fetch_assoc()
    ]);
    exit;
}

/** -------------------------------------------
 *  2. CHECK SPECIAL LOAN TABLE
 * ------------------------------------------*/
$sql2 = "SELECT *, 'special' AS loan_type FROM mpc_special_loan WHERE tracking_code = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $tracking_code);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result2->num_rows > 0) {

    $loan_data = $result2->fetch_assoc();

    $member_id    = $loan_data['member_id'];
    $member_phone = $loan_data['members_phone'];

    /** ---------------------------------------------------------
     *  3. FETCH LATEST SPECIAL SAVINGS BALANCE FOR THE MEMBER
     * --------------------------------------------------------*/
    $sql3 = "SELECT balance, debit, credit, date_time 
             FROM mpc_special_saving 
             WHERE mem_id = ? 
             AND mem_phone = ?
             ORDER BY mem_id DESC 
             LIMIT 1";

    $stmt3 = $conn->prepare($sql3);
    $stmt3->bind_param("is", $member_id, $member_phone);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    $savings = null;

    if ($result3->num_rows > 0) {
        $savings = $result3->fetch_assoc();
    }

    echo json_encode([
        "status" => true,
        "source" => "special",
        "data"   => $loan_data,
        "special_savings" => $savings ?? [
            "balance" => 0,
            "debit"   => 0,
            "credit"  => 0,
            "date_time" => null
        ]
    ]);
    exit;
}


/** -------------------------------------------
 * 4. IF NOTHING FOUND
 * -------------------------------------------*/
echo json_encode([
    "status"  => false,
    "message" => "No loan found for this tracking code"
]);
exit;
