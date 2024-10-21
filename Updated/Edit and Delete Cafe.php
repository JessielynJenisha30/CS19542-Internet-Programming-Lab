<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Delete Cafe Item</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair Display">
    <style>
        body {
            font-family: 'Playfair Display';
            margin: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 50%;
            margin: 0 auto;
        }

        label, select, input {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button.delete {
            background-color: #e74c3c;
        }

        button:hover {
            background-color: #45a049;
        }

        button.delete:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <h1>Edit or Delete Cafe Item</h1>

    <!-- Step 1: Select Item -->
    <form action="edit_delete_cafe.php" method="POST">
        <label for="item">Select Item to Edit or Delete:</label>
        <select id="item" name="item_id" required>
            <option value="">Select an Item</option>
            <?php
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'cafe_db');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch items from the database
            $sql = "SELECT id, category, price, type, alt FROM cafe_menu";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['alt'] . " (Category: " . $row['category'] . ", Price: $" . $row['price'] . ")</option>";
                }
            } else {
                echo "<option value=''>No items found</option>";
            }
            $conn->close();
            ?>
        </select>

        <!-- Step 2: Edit Section -->
        <h2>Edit Item</h2>

        <label for="category">Category:</label>
        <select id="category" name="category">
            <option value="coffee">Coffee</option>
            <option value="tea">Tea</option>
            <option value="cookie">Cookie</option>
            <option value="cake">Cake</option>
            <option value="icecream">Ice Cream</option>
            <option value="veg">Vegetarian</option>
            <option value="non-veg">Non-Vegetarian</option>
            <option value="mocktail">Mocktail</option>
            <option value="juice">Juice</option>
        </select>

        <label for="price">Price:</label>
        <input type="text" id="price" name="price" required>

        <label for="type">Type:</label>
        <select id="type" name="type" required>
            <option value="standard">Standard</option>
            <option value="seasonal">Seasonal</option>
        </select>

        <label for="alt">Alt Text:</label>
        <input type="text" id="alt" name="alt" required>

        <button type="submit" name="edit">Edit Item</button>

        <!-- Step 3: Delete Section -->
        <h2>Delete Item</h2>
        <button type="submit" name="delete" class="delete">Delete Item</button>
    </form>

    <?php
    if (isset($_POST['edit'])) {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'cafe_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize inputs
        $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $type = mysqli_real_escape_string($conn, $_POST['type']);
        $alt = mysqli_real_escape_string($conn, $_POST['alt']);

        // Update the item in the database
        $sql = "UPDATE cafe_menu SET category='$category', price='$price', type='$type', alt='$alt' WHERE id='$item_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Item updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    if (isset($_POST['delete'])) {
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'cafe_db');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize input
        $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);

        // Delete the item from the database
        $sql = "DELETE FROM cafe_menu WHERE id='$item_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Item deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>

</body>
</html>
