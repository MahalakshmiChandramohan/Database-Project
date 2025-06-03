<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        header("Location: user.php?success=1");
        exit();
    } else {
        $message = "<p class='error'>Registration failed.</p>";
    }
}

if (isset($_GET['success'])) {
    $message = "<p class='success'>User registered successfully!</p>";
}
?>

<div class="container">
    <h2>Register New User</h2>
    <?= $message ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</div>

<?php include 'footer.php'; ?>

