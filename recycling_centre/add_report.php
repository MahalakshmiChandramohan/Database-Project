<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];

    $stmt = $conn->prepare("INSERT INTO reports (title, description, date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $date);

    if ($stmt->execute()) {
        header("Location: add_report.php?success=1");
        exit();
    } else {
        $message = "<p class='error'>Failed to add report.</p>";
    }
}

if (isset($_GET['success'])) {
    $message = "<p class='success'>Report added successfully!</p>";
}
?>

<div class="container">
    <h2>Add Report</h2>
    <?= $message ?>
    <form method="POST">
        <input type="text" name="title" placeholder="Report Title" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <input type="date" name="date" required>
        <button type="submit">Add Report</button>
    </form>
</div>

<?php include 'footer.php'; ?>

