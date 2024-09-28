<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_crisporo_db";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: /crud_app_dev/crud.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: /crud_app_dev/crud.php");
        exit;
    } else {
        echo "Error: " . $connection->error;
    }

    $stmt->close();
}

$connection->close();
?>
