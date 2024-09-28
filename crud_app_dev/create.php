<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "crud_crisporo_db";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

      
        $name = $connection->real_escape_string($_POST['name']);
        $description = $connection->real_escape_string($_POST['description']);
        $price = $connection->real_escape_string($_POST['price']);
        $quantity = $connection->real_escape_string($_POST['quantity']);

        
        if (!is_numeric($price) || !is_numeric($quantity)) {
            echo "Price and Quantity should be numeric.";
            $connection->close();
            exit();
        }

        $sql = "INSERT INTO products (name, description, price, quantity) VALUES ('$name', '$description', '$price', '$quantity')";

        if ($connection->query($sql) === TRUE) {
            echo "Successfully Added. <a href='crud.php'>Back</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }

        $connection->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <h2>Create New Product</h2><br>
    <form method="post" action="create.php">
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Description:</label><br>
        <input type="text" id="description" name="description" required><br><br>

        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" required><br><br>

        <label for="quantity">Quantity:</label><br>
        <input type="text" id="quantity" name="quantity" required><br><br>

        <input type="submit" value="Add Product">
    </form>

    <br>
    <a href="/crud_app_dev/crud.php">Back</a>
</body>
</html>
