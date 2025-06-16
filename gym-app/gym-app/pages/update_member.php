<?php
include '../db.php';
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login/admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $member_id = intval($_POST['member_id']);
    $name = $_POST['name'];
    $age = intval($_POST['age']);
    $phone = $_POST['phone'];
    $trainer_id = intval($_POST['trainer_id']);

    $stmt = $conn->prepare("UPDATE Member SET name = ?, age = ?, phone = ?, trainer_id = ? WHERE member_id = ?");
    $stmt->bind_param("siiii", $name, $age, $phone, $trainer_id, $member_id);

    if ($stmt->execute()) {
        header("Location: view_members.php?success=1");
        exit();
    } else {
        echo "Error updating member.";
    }
} else {
    header("Location: view_members.php");
    exit();
}
