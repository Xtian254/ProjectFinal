<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST["psw"]);
    $password_repeat = trim($_POST["psw-repeat"]);
    $remember = isset($_POST["remember"]) ? true : false;

    // Validate input data
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    if (empty($password) || empty($password_repeat)) {
        die("Password and Repeat Password fields are required");
    }

    if ($password !== $password_repeat) {
        die("Passwords do not match");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // (Optional) Save to database
    // Assuming you have a MySQL database connection set up
    /*
    $servername = "your_servername";
    $username = "your_username";
    $dbpassword = "your_dbpassword";
    $dbname = "your_dbname";

    // Create connection
    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $email, $hashed_password);
        $stmt->execute();
        $stmt->close();
    } else {
        die("Error preparing statement: " . $conn->error);
    }

    $conn->close();
    */

    // Provide feedback to the user
    echo "Registration successful! You can now <a href='login.php'>log in</a>.";
} else {
    // If the form wasn't submitted, redirect back to the form
    header("Location: /signup_form.html");
    exit();
}
?>
