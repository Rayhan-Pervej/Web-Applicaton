<?php

$conn = new mysqli("localhost", "root", "", "portfolio");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fetch = "SELECT name, message FROM contactlist";
$result = $conn->query($fetch);

if ($result->num_rows > 0) {
    $data = array();

    while ($row = $result->fetch_assoc()) {
        $data[] = array("name" => $row["name"], "message" => $row["message"]);
    }
    echo json_encode($data);
} else {
    echo "No records found";
}

$conn->close();
?>
