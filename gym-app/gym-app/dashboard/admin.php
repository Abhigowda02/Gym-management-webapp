<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login/admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <a href="../pages/view_members.php" class="btn btn-primary me-2">Manage Members</a>
    <a href="../pages/view_workout_plans.php" class="btn btn-warning">Manage Workout Plans</a>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin Panel</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="../pages/add_member.php">Add Member</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/view_trainers.php">Manage Trainers</a></li>
        <li class="nav-item"><a class="nav-link" href="../pages/workout_plans.php">Workout Plans</a></li>
      </ul>
      <span class="navbar-text text-white me-3">Hi, <?php echo $_SESSION['username']; ?></span>
      <a href="../logout.php" class="btn btn-outline-light">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, Admin</h2>
    
   
</div>

</body>
</html>
