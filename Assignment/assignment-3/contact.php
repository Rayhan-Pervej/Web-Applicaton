<?php

$conn = new mysqli("localhost", "root", "", "portfolio");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $message = isset($_POST["comment"]) ? $_POST["comment"] : '';


    if (empty($name) || empty($email) || empty($message)) {
        echo "Error: All fields are required!";
    }

    else {
        $sql = "INSERT INTO contactlist (name, email, message) VALUES ('$name', '$email', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Message sent successfully!";
        }
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>



