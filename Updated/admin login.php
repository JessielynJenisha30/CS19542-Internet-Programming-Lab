<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Playfair Display">
    <style>
        body {
            font-family: 'Playfair Display', serif;
            margin: 0;
            padding: 0;
            color: #333;
            overflow-x: hidden;
        }

        #login {
            font-family: 'Playfair Display', serif;
            text-align: center;
            margin-top: 50px;
            padding-bottom: 50px;
        }

        #loginForm {
            display: inline-block;
            background-color: #b2d09a;
            padding: 60px;
            border-radius: 20px;
        }

        #loginForm label {
            display: block;
            text-align: left;
            margin-bottom: 10px;
            font-size: 1.2em;
        }

        #loginForm select {
            align-self: left;
            font-family: 'Playfair Display';
            font-size: 1.2em;
        }

        #loginForm input {
            align-self: left;
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 1.2em;
        }

        #loginForm button {
            background-color: #619738;
            font-family: 'Playfair Display';
            text-align: center;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 1.2em;
            border-radius: 5px;
            margin: 0 10px;
        }

        #loginForm button:hover {
            background-color: #4f8625;
        }
    </style>
</head>

<body>
    <section id="login">
        <h1>LOGIN</h1>
        <form id="loginForm" action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>

        <?php
        // Database credentials
        $servername = "localhost"; // Usually localhost
        $username = "root"; // Default username for XAMPP/WAMP
        $password = ""; // Default password for XAMPP/WAMP (empty by default)
        $dbname = "community"; // Your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $username = $_POST['username'];
            $passwordInput = $_POST['password'];

            // Prepare SQL statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT password FROM admins WHERE username = ?");
            $stmt->bind_param("s", $username);

            // Execute the statement
            $stmt->execute();
            $stmt->store_result();

            // Check if the username exists
            if ($stmt->num_rows > 0) {
                // Bind the result
                $stmt->bind_result($hashedPassword);
                $stmt->fetch();

                // Verify the password
                if (password_verify($passwordInput, $hashedPassword)) {
                    echo "<script>alert('Login Successful!'); window.location.href = 'Admin cafe.php';</script>";
                } else {
                    echo "<script>alert('Invalid password.');</script>";
                }
            } else {
                echo "<script>alert('Username not found.');</script>";
            }

            // Close the statement
            $stmt->close();
        }

        // Close the connection
        $conn->close();
        ?>
    </section>
</body>

</html>