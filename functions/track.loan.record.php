<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

header("Content-Type: application/json");

// POST only
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// Read JSON
$input = json_decode(file_get_contents("php://input"), true);

if (!$input || empty($input["tracking_code"])) {
    echo json_encode(["status" => "error", "message" => "Tracking code is required"]);
    exit;
}

$tracking_code = trim($input["tracking_code"]);

try {

    /** ------------------------------
     * 1. CHECK NORMAL LOAN TABLE
     * -----------------------------*/
    $sql1 = "SELECT *, 'normal_loan' AS loan_type 
             FROM mpc_loans 
             WHERE tracking_code = ? 
             LIMIT 1";

    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("s", $tracking_code);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    if ($result1->num_rows > 0) {
        echo json_encode([
            "status" => "success",
            "source_table" => "mpc_loans",
            "data" => $result1->fetch_assoc()
        ]);
        exit;
    }


    /** ------------------------------
     * 2. CHECK SPECIAL LOAN TABLE
     * -----------------------------*/
    $sql2 = "SELECT *, 'special_loan' AS loan_type 
             FROM mpc_special_loan 
             WHERE tracking_code = ? 
             LIMIT 1";

    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $tracking_code);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    if ($result2->num_rows > 0) {
        echo json_encode([
            "status" => "success",
            "source_table" => "mpc_special_loan",
            "data" => $result2->fetch_assoc()
        ]);
        exit;
    }


    /** ------------------------------
     * 3. IF NOTHING IS FOUND
     * -----------------------------*/
    echo json_encode([
        "status" => "error",
        "message" => "No loan record found for tracking code: $tracking_code"
    ]);
    exit;

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

$conn->close();
?>
