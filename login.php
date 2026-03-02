<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrioza - Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="main-title" id="loginTitle">Nutrioza Admin Management 🌾</h1>
        
        <nav class="navbar">
            <a href="index.php" class="nav-link">Home</a>
            <a href="about.php" class="nav-link">About Us</a>
            <a href="contact.php" class="nav-link">Contact Us</a>
            <a href="roles-dashboard.php" class="nav-link">More</a>
        </nav>
        
        <div class="login-container">
            <form id="loginForm" class="login-form" method="POST" action="">
                <h2 id="roleDisplay">Admin Login</h2>
                <input type="hidden" id="roleType" name="roleType">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="submit-btn">Login</button>
                <p id="loginError" class="error-message"></p>
            </form>
        </div>
    </div>
    
    <script src="js/main.js"></script>
</body>
</html>