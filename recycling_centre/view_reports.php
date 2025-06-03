<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$result = $conn->query("SELECT * FROM reports");
?>

<div class="container">
    <h2>Reports</h2>
    <table class="styled-table">
        <thead>
            <tr><th>ID</th><th>Title</th><th>Description</th><th>Date</th></tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td><?= $row['date'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

