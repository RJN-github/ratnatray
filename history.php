<?php
include('database.php');

try {
    $sql = "SELECT * FROM bills ORDER BY created_at DESC";
    $result = $conn->query($sql);

    $bills = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bills[] = $row;
        }
    }
    header("Content-Type: application/json");
    echo json_encode($bills);

} catch (mysqli_sql_exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
