<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $weight = $_POST['weight'];
    $date = $_POST['received_date'];

    $stmt = $conn->prepare("INSERT INTO items (name, category, weight, received_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssds", $name, $category, $weight, $date);

    if ($stmt->execute()) {
        header("Location: add_item.php?success=1");
        exit();
    } else {
        $message = "<p class='error'>Failed to add item.</p>";
    }
}

if (isset($_GET['success'])) {
    $message = "<p class='success'>Item added successfully!</p>";
}
?>

<div class="container">
    <h2>Add Recyclable Item</h2>
    <?= $message ?>
    <form method="POST">
        <input type="text" name="name" placeholder="Item Name" required>
        <input type="text" name="category" placeholder="Category (e.g., Plastic, Metal)" required>
        <input type="number" step="0.01" name="weight" placeholder="Weight (kg)" required>
        <input type="date" name="received_date" required>
        <button type="submit">Add Item</button>
    </form>
</div>

<?php include 'footer.php'; ?>

