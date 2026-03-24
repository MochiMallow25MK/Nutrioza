<?php
session_start();
$role = isset($_GET['role']) ? $_GET['role'] : '';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Nutrioza</title>
    <link href="https://fonts.googleapis.com/css2?family=Vidaloka&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
    <script src="login_validation.js"></script>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Welcome back !</h2>
            <p class="role-text"><?php echo $role; ?> Login</p>
            
            <form id="loginForm" onsubmit="return validateLoginForm()" action="authenticate.php" method="POST">
                <input type="hidden" name="role" value="<?php echo $role; ?>">
                
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username">
                    <span id="usernameError" class="error"></span>
                </div>
                
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                    <span id="passwordError" class="error"></span>
                </div>
                
                <button type="submit">Sign in</button>
                
                <div class="links">
                    <a href="rolesdashboard.php">Go back</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>