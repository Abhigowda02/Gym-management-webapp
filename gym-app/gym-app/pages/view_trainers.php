<?php
include '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch trainers and their gym locations
$sql = "SELECT Trainer.trainer_id, Trainer.name AS trainer_name, GymBranch.location AS gym_location
        FROM Trainer
        LEFT JOIN GymBranch ON Trainer.gym_id = GymBranch.gym_id";
$trainers = $conn->query($sql);

// Fetch gym branches for dropdown
$gyms = $conn->query("SELECT * FROM GymBranch");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Trainers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Trainer Management</h2>

    <form method="POST" class="mb-4">
        <div class="row g-3">
            <div class="col-md-5">
                <input type="text" name="trainer_name" class="form-control" placeholder="Trainer Name" required>
            </div>
            <div class="col-md-5">
                <select name="gym_id" class="form-control" required>
                    <option value="">Select Gym Branch</option>
                    <?php while ($row = $gyms->fetch_assoc()) {
                        echo "<option value='{$row['gym_id']}'>{$row['location']}</option>";
                    } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" name="add_trainer" class="btn btn-success w-100">Add</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['add_trainer'])) {
        $name = $_POST['trainer_name'];
        $gym_id = $_POST['gym_id'];

        $stmt = $conn->prepare("INSERT INTO Trainer (name, gym_id) VALUES (?, ?)");
        $stmt->bind_param("si", $name, $gym_id);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Trainer added successfully!</div>";
            header("Refresh:0"); // Refresh page to reload data
        } else {
            echo "<div class='alert alert-danger'>Error adding trainer.</div>";
        }
    }
    ?>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Trainer Name</th>
                <th>Gym Branch</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row = $trainers->fetch_assoc()) {
                echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['trainer_name']}</td>
                        <td>{$row['gym_location']}</td>
                    </tr>";
                $count++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
