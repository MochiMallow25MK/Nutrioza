<?php
session_start();
// If already logged in, go straight to workspace
if (!empty($_SESSION['logged_in'])) {
    header("Location: workspace.php");
    exit();
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config.php';
    require_once 'controllers/AuthController.php';
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } elseif (AuthController::login($username, $password)) {
        header("Location: workspace.php");
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Management Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh; background:var(--cream); }
        .login-box { background:#fff; border:1.5px solid var(--green-3); border-radius:12px; padding:40px 36px; width:100%; max-width:400px; }
        .login-box h2 { text-align:center; color:var(--green-dark); margin-bottom:28px; font-size:1.5rem; letter-spacing:1px; }
        .login-logo { text-align:center; font-size:2rem; margin-bottom:8px; color:var(--green-dark); letter-spacing:3px; }
    </style>
</head>
<body>
<script>alert('Welcome to Management!');</script>

<div class="login-box">
    <div class="login-logo">NUTRIOZA 🌾</div>
    <h2>Management Login</h2>

    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" action="management.php" id="loginForm" novalidate>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username"
                   value="<?= htmlspecialchars($_POST['username'] ?? '') ?>">
            <span class="error-msg" id="userErr">Username is required.</span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password">
            <span class="error-msg" id="passErr">Password is required.</span>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%; margin-top:8px;">LOGIN</button>
    </form>
    <p style="text-align:center; margin-top:16px; font-size:13px;">
        <a href="homepage.php" style="color:var(--green-mid);">← Back to Homepage</a>
    </p>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    let valid = true;
    document.querySelectorAll('.error-msg').forEach(el => el.style.display = 'none');
    document.querySelectorAll('input').forEach(el => el.classList.remove('error'));

    if (!document.getElementById('username').value.trim()) {
        document.getElementById('userErr').style.display = 'block';
        document.getElementById('username').classList.add('error');
        valid = false;
    }
    if (!document.getElementById('password').value.trim()) {
        document.getElementById('passErr').style.display = 'block';
        document.getElementById('password').classList.add('error');
        valid = false;
    }
    if (!valid) e.preventDefault();
});
</script>
</body>
</html>