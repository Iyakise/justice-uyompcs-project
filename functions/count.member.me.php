<?php
header("Content-Type: application/json");
define('__mpc_connection__', dirname(__DIR__));
require __mpc_connection__ . '/config/conn.php';

try {
    // Count total members
    $memberResult = $conn->query("SELECT COUNT(*) AS total_members FROM mpc_members");
    if (!$memberResult) throw new Exception($conn->error);
    $totalMembers = $memberResult->fetch_assoc()['total_members'];

    // Count total loan requests
    $loanResult = $conn->query("SELECT COUNT(*) AS total_loans FROM mpc_loans");
    if (!$loanResult) throw new Exception($conn->error);
    $totalLoans = $loanResult->fetch_assoc()['total_loans'];

    $loanResult = $conn->query("SELECT COUNT(*) AS total_special_loans FROM mpc_special_loan");
    if (!$loanResult) throw new Exception($conn->error);
    $totalSpecialLoans = $loanResult->fetch_assoc()['total_special_loans'];

    echo json_encode([
        "status" => true,
        "total_members" => (int)$totalMembers,
        "total_loans" => (int)$totalLoans,
        "total_special_loans" => (int)$totalSpecialLoans        
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => false,
        "message" => $e->getMessage()
    ]);
}
?>
