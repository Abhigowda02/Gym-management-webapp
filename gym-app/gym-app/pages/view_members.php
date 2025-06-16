<?php
include '../db.php';
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login/admin_login.php");
    exit();
}

$result = $conn->query("SELECT Member.member_id, Member.name, Member.age, Member.phone, Trainer.name AS trainer_name
                       FROM Member
                       LEFT JOIN Trainer ON Member.trainer_id = Trainer.trainer_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Members List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Members</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Name</th><th>Age</th><th>Phone</th><th>Trainer</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['member_id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= htmlspecialchars($row['phone']) ?></td>
                    <td><?= htmlspecialchars($row['trainer_name']) ?></td>
                    <td>
                        <a href="edit_member.php?id=<?= $row['member_id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
