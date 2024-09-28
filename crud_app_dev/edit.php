<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_crisporo_db";

$connection = new mysqli($servername, $username, $password, $database);

$id = "";
$name = "";
$description = "";
$price = "";
$quantity = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("Location: /crud_app_dev/crud.php");
        exit;
    }
    $id = $_GET["id"];

    $sql = "SELECT * FROM products WHERE id=?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: /crud_app_dev/crud.php");
        exit;
    }
    $name = $row["name"];
    $description = $row["description"];
    $price = $row["price"];
    $quantity = $row["quantity"];
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if (empty($name) || empty($description) || empty($price) || empty($quantity)) {
        $errorMessage = "All fields are required";
    } else {
        $sql = "UPDATE products SET name=?, description=?, price=?, quantity=? WHERE id=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssdi", $name, $description, $price, $quantity, $id);
        if ($stmt->execute()) {
            $successMessage = "Product updated successfully";
            header("Location: /crud_app_dev/crud.php");
            exit;
        } else {
            $errorMessage = "Error: " . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>

    <?php
    if (!empty($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    }
    if (!empty($successMessage)) {
        echo "<p style='color: green;'>$successMessage</p>";
    }
    ?>

    <form method="post" action="edit.php">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" readonly>
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br><br>

        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description" value="<?php echo htmlspecialchars($description); ?>" required><br><br>

        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required><br><br>

        <label for="quantity">Quantity:</label><br>
        <input type="text" id="quantity" name="quantity" value="<?php echo htmlspecialchars($quantity); ?>" required><br><br>

        <input type="submit" value="Update Product">
        <a href="/crud_app_dev/crud.php">Back</a>
    </form>
</body>
</html>
