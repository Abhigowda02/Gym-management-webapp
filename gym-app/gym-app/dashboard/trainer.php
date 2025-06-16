<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'trainer') {
    header("Location: ../login/trainer_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Trainer Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <a href="../dashboard/trainer_members.php" class="btn btn-primary me-2">My Members</a>
    <a href="../pages/view_workout_plans.php" class="btn btn-warning">Workout Plans</a>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Trainer Panel</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
  <li class="nav-item"><a class="nav-link" href="trainer_members.php">My Members</a></li>
</ul>

      <span class="navbar-text text-white me-3">Hi,
