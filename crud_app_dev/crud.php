<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
</head>
<body>
    <h2>List of Products</h2>
    <a href="/crud_app_dev/create.php">New Product</a>
    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "crud_crisporo_db";

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM products";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['create_at']}</td>
                    <td>{$row['update_at']}</td>
                    <td>
                       <a href='/crud_app_dev/edit.php?id={$row['id']}'>Edit</a> |
                        <a href='/crud_app_dev/delete.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
