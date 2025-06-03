<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bin_name = $_POST['bin_name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("INSERT INTO bins (bin_name, location, capacity, type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $bin_name, $location, $capacity, $type);

    if ($stmt->execute()) {
        header("Location: add_bin.php?success=1");
        exit();
    } else {
        $message = "<p class='error'>Failed to add bin.</p>";
    }
}

if (isset($_GET['success'])) {
    $message = "<p class='success'>Bin added successfully!</p>";
}
?>

<div class="container">
    <h2>Add Bin</h2>
    <?= $message ?>
    <form method="POST">
        <input type="text" name="bin_name" placeholder="Bin Name" required>
        <input type="text" name="location" placeholder="Location" required>
        <input type="number" name="capacity" placeholder="Capacity (kg)" required>
        <input type="text" name="type" placeholder="Type (e.g., Plastic, Metal)" required>
        <button type="submit">Add Bin</button>
    </form>
</div>

<?php include 'footer.php'; ?>

