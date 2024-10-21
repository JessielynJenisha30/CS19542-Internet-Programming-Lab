<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
    <link rel="stylesheet" href="styles1.css">
</head>

<body>
    <section id="login">
        <h2>SIGN UP</h2>
        <form id="loginForm" action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Select your gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="c_password">Confirm Password:</label>
            <input type="password" id="c_password" name="c_password" required>

            <button type="reset"> Reset </button>
            <button type="submit" onclick="submitForm(event)">Sign Up</button>
        </form>

        <script>
            function submitForm(event) {
                event.preventDefault(); // Prevent form from submitting by default
                const form = document.getElementById("loginForm");
                const password = document.getElementById("password").value;
                const c_password = document.getElementById("c_password").value;

                if (form.checkValidity()) { // Check if all fields are valid
                    if (password === c_password) { // Check if passwords match
                        form.submit(); // Submit the form if passwords match
                    } else {
                        alert("Passwords do not match.");
                    }
                } else {
                    alert("Please fill in all required fields correctly.");
                }
            }
        </script>

        <?php
        // Database credentials
        $servername = "localhost"; // Usually localhost
        $db_username = "root"; // Default username for XAMPP/WAMP
        $db_password = ""; // Default password for XAMPP/WAMP (empty by default)
        $dbname = "community"; // Your database name

        // Create connection
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $dob = $_POST['dob'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $c_password = $_POST['c_password'];

            // Check if passwords match
            if ($password !== $c_password) {
                echo "<script>alert('Passwords do not match. Please try again.');</script>";
            } else {
                // Hash the password before storing it
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Prepare SQL statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO users (name, gender, dob, username, email, password) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $name, $gender, $dob, $username, $email, $hashed_password);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "<script>alert('Submitted successfully!'); window.location.href = 'index.html';</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            }
        }

        // Close the connection
        $conn->close();
        ?>
    </section>
</body>

</html>
