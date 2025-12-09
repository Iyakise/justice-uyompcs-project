<?php
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

header("Content-Type: application/json");

// Allow POST only
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
    exit;
}

// Read JSON input
$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode(["status" => "error", "message" => "Invalid JSON input"]);
    exit;
}

// Required fields
$required_fields = [
    "member_id",
    "loan_amount",
    "interest_rate",
    "total_payable",
    "duration_months",
    "repayment_frequency",
    "monthly_payment",
    "due_date"
];

foreach ($required_fields as $field) {
    if (!isset($input[$field]) || $input[$field] === "") {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required field: $field"
        ]);
        exit;
    }
}

// Assign values
$member_id       = intval($input["member_id"]);
$member_phone    = $input["member_phone"] ?? '';
$loan_amount     = floatval($input["loan_amount"]);
$interest_rate   = floatval($input["interest_rate"]);
$total_payable   = floatval($input["total_payable"]);
$duration_months = intval($input["duration_months"]);
$frequency       = $input["repayment_frequency"];
$monthly_payment = floatval($input["monthly_payment"]);
$due_date_raw = $input["due_date"];
$due_date = date("Y-m-d H:i:s", strtotime($due_date_raw));


// Defaults
$status      = "pending";
$approved_by = null;
$issued_at   = null;
$created_at  = date("Y-m-d H:i:s");
$updated_at  = date("Y-m-d H:i:s");

//  echo json_encode([
//             "status" => "error",
//             "message" => $frequency
//             ]);
//             return;
// Generate unique tracking code
$tracking_code = 'LN' . strtoupper(substr(uniqid(), -8));

try {
    $stmt = $conn->prepare("
        INSERT INTO mpc_loans 
        (tracking_code, member_id, members_phone, loan_amount, interest_rate, total_payable,
        duration_months, repayment_frequency, monthly_payment, status, approved_by,
        issued_at, due_date, created_at, updated_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if ($stmt === false) {
    throw new Exception($conn->error);
}
$freq = 'Monthly';
/**
 * Bind types:
 * s = string
 * i = integer
 * d = double (float)
 */
$stmt->bind_param(
    "sisddissssdssss",
    $tracking_code,     // s
    $member_id,         // i
    $member_phone,      // s
    $loan_amount,       // d
    $interest_rate,     // d
    $total_payable,     // d
    $duration_months,   // i
    $freq,              // s
    $monthly_payment,   // d
    $status,            // s
    $approved_by,       // s (NULL allowed)
    $issued_at,         // s (NULL allowed)
    $due_date,          // s
    $created_at,        // s
    $updated_at         // s
);



    $exec = $stmt->execute();

    if ($exec) {

        // Prepare SMS message
    // $sms_message = urlencode("Dear member, your loan request has been submitted successfully. Tracking Code: $tracking_code");

    // $sms_api_key = "YOUR_SMS_API_KEY";
    // $recipient = $member_phone;

    // // Bulk SMS API URL
    // $sms_url = "https://smsprovider.com/api/send?api_key=$sms_api_key&to=$recipient&message=$sms_message";

    // // Send SMS using curl
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $sms_url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // $sms_response = curl_exec($ch);
    // curl_close($ch);


        echo json_encode([
            "status" => "success",
            "message" => "Loan request submitted successfully",
            "loan_id" => $stmt->insert_id,
            "tracking_code" => $tracking_code
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to save loan application: " . $stmt->error
        ]);
    }

    $stmt->close();

} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
$conn->close();