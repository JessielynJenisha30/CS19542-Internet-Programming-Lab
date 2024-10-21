<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Admin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair Display">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Averia Serif Libre">
    <style>
        body {
            font-family: 'Playfair Display';
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            font-family: 'Averia Serif Libre';
            text-align: center;
            margin-top: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 400px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input,
        select,
        button {
            font-family: 'Playfair Display';
            margin-bottom: 20px;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            font-family: 'Playfair Display';
            background-color: #ff5c5c;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff4747;
        }

        .admin-buttons {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .admin-buttons button {
            margin: 0 10px;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .admin-buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Add Cafe Item</h1>

    <form action="Admin cafe.php" method="POST" enctype="multipart/form-data">
        <label for="category">Category:</label>
        <select id="data-category" name="category" required>
            <option value="">Select a category</option>
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
        <select id="data-category" name="category" required>
            <option value="">Select a category</option>
            <option value="standard">Standard</option>
            <option value="seasonal">Seasonal</option>
        </select>

        <label for="img src">Image Source (URL or upload):</label>
        <input type="file" id="img src" name="img_src" required>

        <label for="alt">Alt Text:</label>
        <input type="text" id="alt" name="alt" required>

        <button type="submit" name="submit">Add Item</button>
    </form>

    <?php
        if (isset($_POST['submit'])) {
            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'cafe_db');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Sanitize inputs
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $price = mysqli_real_escape_string($conn, $_POST['price']);
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $alt = mysqli_real_escape_string($conn, $_POST['alt']);
            
            // Image handling
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["img_src"]["name"]);
            move_uploaded_file($_FILES["img_src"]["tmp_name"], $target_file);
            $img_src = $target_file;
            
            // Insert into the database
            $sql = "INSERT INTO cafe_menu (category, price, type, img_src, alt) 
                    VALUES ('$category', '$price', '$type', '$img_src', '$alt')";
            
            if ($conn->query($sql) === TRUE) {
                echo "New item added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        }
    ?>
</body>

</html>