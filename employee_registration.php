<?php
session_start();
$message = "";

// Only run when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect and sanitize form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $position = trim($_POST['position']);
    $department = trim($_POST['department']);
    $password = trim($_POST['password']); // Get password

    // Basic validation
    if (empty($name) || empty($email) || empty($position) || empty($department) || empty($password)) {
        $message = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format.";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Connect to MySQL database
        $servername = "localhost";
        $username = "root";
        $password_db = "";
        $dbname = "employee_management"; // ✅ Your DB name

        // Create connection
        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare SQL for the correct table name
        $stmt = $conn->prepare("INSERT INTO employees (name, email, position, department, password) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("SQL Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssss", $name, $email, $position, $department, $hashed_password);

        // Execute and check success
        if ($stmt->execute()) {
            // ✅ Auto login after successful registration
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            if ($conn->errno == 1062) {
                $message = "Registration failed: Email already exists.";
            } else {
                $message = "Registration failed: " . $conn->error;
            }
        }

        $stmt->close();
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            padding: 40px;
        }
        form {
            background: #fff;
            max-width: 450px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input[type=text], input[type=email], input[type=password] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            background-color: #007BFF;
            color: white;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Employee Registration</h2>

<?php if (!empty($message)): ?>
    <p class="message <?php echo strpos($message, 'failed') !== false ? 'error' : ''; ?>">
        <?php echo $message; ?>
    </p>
<?php endif; ?>

<form method="POST" action="">
    <label for="name">Full Name</label>
    <input type="text" name="name" id="name" placeholder="Enter full name" required>

    <label for="email">Email Address</label>
    <input type="email" name="email" id="email" placeholder="Enter email address" required>

    <label for="position">Position</label>
    <input type="text" name="position" id="position" placeholder="Enter position" required>

    <label for="department">Department</label>
    <input type="text" name="department" id="department" placeholder="Enter department" required>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter password" required>

    <button type="submit">Register Employee</button>
</form>

</body>
</html>
