<?php
header("Content-Type: application/json");
define("__mpc_connection__", dirname(__DIR__));
require __mpc_connection__ . "/config/conn.php";

$input = json_decode(file_get_contents("php://input"), true);
$tracking_code = $input['tracking_code'] ?? null;
$admin_name    = $input['approved_by'] ?? null;
$msg           = $input['reject_message'] ?? null;

if (!$tracking_code || !$admin_name || !$msg) {
    echo json_encode([
        "status" => false,
        "message" => "tracking_code, Rejection Message and admin_name are required"
    ]);
    exit;
}

/**
 * STEP 1 — CHECK IN NORMAL LOAN TABLE
 */
$sql1 = "SELECT id FROM mpc_loans WHERE tracking_code = ? LIMIT 1";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("s", $tracking_code);
$stmt1->execute();
$res1 = $stmt1->get_result();

if ($res1->num_rows > 0) {
    $loan = $res1->fetch_assoc();
    $loan_id = $loan["id"];

    // Reject this normal loan
    $update = "UPDATE mpc_loans 
               SET status = 'rejected', approved_by = ?, message=?, updated_at = NOW() 
               WHERE id = ?";

    $stmtU = $conn->prepare($update);
    $stmtU->bind_param("ssi", $admin_name, $msg, $loan_id);


    if ($stmtU->execute()) {
        echo json_encode([
            "status" => true,
            "loan_type" => "normal",
            "message" => "Loan rejected successfully"
        ]);
        exit;
    }

    echo json_encode([
        "status" => false,
        "message" => "Failed to reject loan",
        "error" => $stmtU->error
    ]);
    exit;
}


/**
 * STEP 2 — CHECK IN SPECIAL LOAN TABLE
 */
$sql2 = "SELECT id FROM mpc_special_loan WHERE tracking_code = ? LIMIT 1";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("s", $tracking_code);
$stmt2->execute();
$res2 = $stmt2->get_result();

if ($res2->num_rows > 0) {
    $loan = $res2->fetch_assoc();
    $loan_id = $loan["id"];

    // Reject this special loan
    $update = "UPDATE mpc_special_loan
               SET status = 'rejected', approved_by = ?, updated_at = NOW() 
               WHERE id = ?";

    $stmtU = $conn->prepare($update);
    $stmtU->bind_param("si", $admin_name, $loan_id);

    if ($stmtU->execute()) {
        echo json_encode([
            "status" => true,
            "loan_type" => "special",
            "message" => "Special loan rejected successfully"
        ]);
        exit;
    }

    echo json_encode([
        "status" => false,
        "message" => "Failed to reject special loan",
        "error" => $stmtU->error
    ]);
    exit;
}


/**
 * NOTHING FOUND
 */
echo json_encode([
    "status" => false,
    "message" => "Invalid tracking code. No loan found."
]);
exit;

?>
