<?php
include '../db.php';
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login/admin_login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: view_members.php");
    exit();
}

$id = intval($_GET['id']);

// Fetch member data
$stmt = $conn->prepare("SELECT * FROM Member WHERE member_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

if (!$member) {
    echo "Member not found!";
    exit();
}

// Fetch all trainers for dropdown
$trainers = $conn->query("SELECT trainer_id, name FROM Trainer");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Member: <?= htmlspecialchars($member['name']) ?></h2>
    <form method="POST" action="update_member.php">
        <input type="hidden" name="member_id" value="<?= $member['member_id'] ?>">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($member['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" value="<?= $member['age'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($member['phone']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Trainer</label>
            <select name="trainer_id" class="form-control" required>
                <option value="">Select Trainer</option>
                <?php while ($t = $trainers->fetch_assoc()): ?>
                    <option value="<?= $t['trainer_id'] ?>" <?= ($t['trainer_id'] == $member['trainer_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($t['name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update Member</button>
        <a href="view_members.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
