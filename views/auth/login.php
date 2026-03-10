<?php
session_start();
$role = isset($_GET['role']) ? $_GET['role'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Nutrioza</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/SEProject/Nutrioza/Nutrioza/public/css/login.css">
    <script src="/SEProject/Nutrioza/Nutrioza/public/js/login_validation.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Welcome back !</h2>
            <p class="role-text"><?php echo $role; ?> Login</p>
            
            <form id="loginForm" onsubmit="return validateLoginForm()" action="/SEProject/Nutrioza/Nutrioza/public/index.php?page=authenticate" method="POST">
                <input type="hidden" name="role" value="<?php echo $role; ?>">
                
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" id="username" name="username" placeholder="giga@example.com">
                    <span id="usernameError" class="error"></span>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password">
                    <span id="passwordError" class="error"></span>
                </div>
                
                <button type="submit">Sign in</button>
                
                <div class="links">
                    <a href="/SEProject/Nutrioza/Nutrioza/views/pages/rolesdashboard.php?page=roles-dashboard">Go back</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>