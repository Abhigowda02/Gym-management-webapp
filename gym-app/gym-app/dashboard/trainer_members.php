<?php
session_start();
include '../db.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'trainer') {
    header("Location: ../login/trainer_login.php");
    exit();
}

// Get trainer_id from logged-in user
$username = $_SESSION['username'];
$getTrainerId = $conn->prepare("SELECT trainer_id FROM Users WHERE username = ?");
$getTrainerId->bind_param("s", $username);
$getTrainerId->execute();
$getTrainerId->bind_result($trainer_id);
$getTrainerId->fetch();
$getTrainerId->close();

// Fetch members assigned to this trainer
$stmt = $conn->prepare("SELECT name, age, phone FROM Member WHERE trainer_id = ?");
$stmt->bind_param("i", $trainer_id);
$stmt->execute();
$members = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assigned Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Your Assigned Members</h3>
    <?php if ($members->num_rows > 0): ?>
    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Name</th><th>Age</th><th>Phone</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $members->fetch_assoc()): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['age'] ?></td>
                <td><?= $row['phone'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
    <div class="alert alert-info">No members assigned yet.</div>
    <?php endif; ?>
</div>

</body>
</html>
