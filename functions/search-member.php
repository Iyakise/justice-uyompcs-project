<?php
define('__mpc_connection__', dirname(__DIR__));
header("Content-Type: application/json; charset=UTF-8");

require_once __mpc_connection__ . "/config/conn.php"; // database connection

// ✅ Only allow POST (or GET if you prefer — adjust accordingly)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method"
    ]);
    exit;
}

// ✅ Get input (JSON or form data)
$input = json_decode(file_get_contents("php://input"), true);
$search = isset($input['search']) ? trim($input['search']) : (isset($_POST['search']) ? trim($_POST['search']) : '');

if (empty($search)) {
    echo json_encode([
        "status" => "error",
        "message" => "Search term is required"
    ]);
    exit;
}

// ✅ Prepare search query (search by name, phone, or registration number)
$sql = "
    SELECT 
        members_id,
        title,
        sex,
        name,
        contact_addr,
        phone,
        lga,
        registration_number
    FROM mpc_members
    WHERE name LIKE ? 
       OR phone LIKE ? 
       OR registration_number LIKE ?
    ORDER BY name ASC
    LIMIT 50
";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode([
        "status" => "error",
        "message" => "Prepare failed: " . $conn->error
    ]);
    exit;
}

$like = "%{$search}%";
$stmt->bind_param("sss", $like, $like, $like);
$stmt->execute();
$result = $stmt->get_result();

$members = [];
while ($row = $result->fetch_assoc()) {
    $members[] = $row;
}

$stmt->close();
$conn->close();

// ✅ Send JSON response
echo json_encode([
    "status" => "success",
    "count" => count($members),
    "data" => $members
], JSON_PRETTY_PRINT);
?>
