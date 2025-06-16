<?php
include '../db.php';
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit();
}

// Fetch all members
$members = $conn->query("SELECT member_id, name FROM Member");

// Fetch existing workout plans
$sql = "SELECT WorkoutPlan.workout_id, WorkoutPlan.name AS plan_name, Member.name AS member_name
        FROM WorkoutPlan
        INNER JOIN Member ON WorkoutPlan.member_id = Member.member_id";
$plans = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Workout Plans</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Assign Workout Plan</h2>

    <form method="POST" class="mb-4">
        <div class="row g-3">
            <div class="col-md-5">
                <input type="text" name="workout_name" class="form-control" placeholder="Workout Plan Name" required>
            </div>
            <div class="col-md-5">
                <select name="member_id" class="form-control" required>
                    <option value="">Assign to Member</option>
                    <?php while ($row = $members->fetch_assoc()) {
                        echo "<option value='{$row['member_id']}'>{$row['name']}</option>";
                    } ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" name="assign_plan" class="btn btn-warning w-100">Assign</button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['assign_plan'])) {
        $plan_name = $_POST['workout_name'];
        $member_id = $_POST['member_id'];

        $stmt = $conn->prepare("INSERT INTO WorkoutPlan (name, member_id) VALUES (?, ?)");
        $stmt->bind_param("si", $plan_name, $member_id);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Workout Plan assigned!</div>";
            header("Refresh:0"); // Reload to show updated list
        } else {
            echo "<div class='alert alert-danger'>Failed to assign plan.</div>";
        }
    }
    ?>

    <h4 class="mt-5">Assigned Workout Plans</h4>
    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Workout Plan</th>
                <th>Member Name</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count = 1;
            while ($row = $plans->fetch_assoc()) {
                echo "<tr>
                        <td>{$count}</td>
                        <td>{$row['plan_name']}</td>
                        <td>{$row['member_name']}</td>
                      </tr>";
                $count++;
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
