<?php
include 'header.php';
require_once 'db.php';

$db = new Database();
$conn = $db->conn;

$result = $conn->query("SELECT * FROM users");
?>

<div class="container">
    <h2>Registered Users</h2>
    <table class="styled-table">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th></tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

