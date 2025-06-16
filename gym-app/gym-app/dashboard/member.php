<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'member') {
    header("Location: ../login/member_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Member Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Member Panel</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="#">My Workout Plan (Coming Soon)</a></li>
      </ul>
      <span class="navbar-text text-dark me-3">Hi, <?php echo $_SESSION['username']; ?></span>
      <a href="../logout.php" class="btn btn-outline-dark">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>Welcome, Member</h2>
    <p>Track your workout plans and sessions. (To be implemented)</p>
</div>
</body>
</html>
