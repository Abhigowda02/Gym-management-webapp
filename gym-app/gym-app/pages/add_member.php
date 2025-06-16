<?php
include '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Get gym branches and trainers for dropdowns
$gyms = $conn->query("SELECT * FROM GymBranch");
$trainers = $conn->query("SELECT * FROM Trainer");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add New Member</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Age</label>
            <input type="number" name="age" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Trainer</label>
            <select name="trainer_id" class="form-control" required>
                <option value="">-- Select Trainer --</option>
                <?php while ($row = $trainers->fetch_assoc()) {
                    echo "<option value='{$row['trainer_id']}'>{$row['name']}</option>";
                } ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Gym Branch</label>
            <select name="gym_id" class="form-control" required>
                <option value="">-- Select Gym Branch --</option>
                <?php while ($row = $gyms->fetch_assoc()) {
                    echo "<option value='{$row['gym_id']}'>{$row['location']}</option>";
                } ?>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Add Member</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $phone = $_POST['phone'];
        $trainer_id = $_POST['trainer_id'];
        $gym_id = $_POST['gym_id'];

        $stmt = $conn->prepare("INSERT INTO Member (name, age, phone, trainer_id, gym_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisii", $name, $age, $phone, $trainer_id, $gym_id);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success mt-3'>Member added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger mt-3'>Error adding member.</div>";
        }
    }
    ?>
</div>
</body>
</html>
