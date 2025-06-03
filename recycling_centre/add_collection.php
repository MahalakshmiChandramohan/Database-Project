<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$message = "";

$bins = $conn->query("SELECT id, bin_name FROM bins");
$items = $conn->query("SELECT id, name FROM items");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bin_id = $_POST['bin_id'];
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $collection_date = $_POST['collection_date'];

    $stmt = $conn->prepare("INSERT INTO collections (bin_id, item_id, quantity, collection_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iids", $bin_id, $item_id, $quantity, $collection_date);

    if ($stmt->execute()) {
        header("Location: add_collection.php?success=1");
        exit();
    } else {
        $message = "<p class='error'>Failed to log collection.</p>";
    }
}

if (isset($_GET['success'])) {
    $message = "<p class='success'>Collection logged successfully!</p>";
}
?>

<div class="container">
    <h2>Add Collection</h2>
    <?= $message ?>
    <form method="POST">
        <label>Bin:</label>
        <select name="bin_id" required>
            <?php while ($bin = $bins->fetch_assoc()): ?>
                <option value="<?= $bin['id'] ?>"><?= htmlspecialchars($bin['bin_name']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Item:</label>
        <select name="item_id" required>
            <?php while ($item = $items->fetch_assoc()): ?>
                <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['name']) ?></option>
            <?php endwhile; ?>
        </select>

        <input type="number" step="0.01" name="quantity" placeholder="Quantity (kg)" required>
        <input type="date" name="collection_date" required>
        <button type="submit">Add Collection</button>
    </form>
</div>

<?php include 'footer.php'; ?>


