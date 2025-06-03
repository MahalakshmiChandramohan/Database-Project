<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$result = $conn->query("SELECT * FROM bins");
?>

<div class="container">
    <h2>Bins</h2>
    <table class="styled-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Location</th><th>Capacity</th><th>Type</th></tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['bin_name']) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td><?= $row['capacity'] ?></td>
                    <td><?= htmlspecialchars($row['type']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

