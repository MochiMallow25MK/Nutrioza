<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nutrioza</title>
    <link rel="stylesheet" href="/nutrioza/assets/css/app.css">
    <link rel="stylesheet" href="/nutrioza/assets/css/public.css">
</head>
<body style="background: linear-gradient(135deg, #31694E 0%, #658C58 100%); min-height: 100vh; display: flex; align-items: center;">
    <div class="container">
        <div class="card" style="max-width: 400px; margin: 0 auto;">
            <div class="card-header">
                <h2 style="text-align: center;">Welcome to Nutrioza</h2>
            </div>
            
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>
            
            <form action="/nutrioza/login.php?action=login" method="POST" id="loginForm" onsubmit="return validateLoginForm()">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="error" id="emailError"></div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    <div class="error" id="passwordError"></div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
            
            <p style="text-align: center; margin-top: 20px; color: #626F47;">
                Demo: admin@nutrioza.org / Admin@123
            </p>
        </div>
    </div>
    
    <script>
    function validateLoginForm() {
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let isValid = true;
        
        document.getElementById('emailError').innerHTML = '';
        document.getElementById('passwordError').innerHTML = '';
        
        if(email.trim() === '') {
            document.getElementById('emailError').innerHTML = 'Email is required';
            isValid = false;
        } else if(!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            document.getElementById('emailError').innerHTML = 'Invalid email format';
            isValid = false;
        }
        
        if(password.trim() === '') {
            document.getElementById('passwordError').innerHTML = 'Password is required';
            isValid = false;
        } else if(password.length < 6) {
            document.getElementById('passwordError').innerHTML = 'Password must be at least 6 characters';
            isValid = false;
        }
        
        return isValid;
    }
    </script>
</body>
</html>