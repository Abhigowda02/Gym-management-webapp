<?php include '../db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Trainer Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex justify-content-center align-items-center" style="height:100vh">
    <form action="login_process.php" method="POST" class="bg-light p-4 rounded shadow" style="width: 350px;">
        <h3 class="mb-3 text-center">Trainer Login</h3>

        <?php if (isset($_GET['error'])): ?>
            <div class='alert alert-danger'>Invalid credentials</div>
        <?php endif; ?>

        <input type="hidden" name="role" value="trainer">

        <div class="mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button type="submit" class="btn btn-success w-100">Login</button>
    </form>
</body>
</html>
