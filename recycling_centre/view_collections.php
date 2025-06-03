<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$sql = "
    SELECT c.id, b.bin_name, i.name AS item_name, c.quantity, c.collection_date 
    FROM collections c
    JOIN bins b ON c.bin_id = b.id
    JOIN items i ON c.item_id = i.id
";
$result = $conn->query($sql);
?>

<div class="container">
    <h2>Collection Records</h2>
    <table class="styled-table">
        <thead>
            <tr><th>ID</th><th>Bin</th><th>Item</th><th>Quantity (kg)</th><th>Date</th></tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['bin_name']) ?></td>
                    <td><?= htmlspecialchars($row['item_name']) ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td><?= $row['collection_date'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

