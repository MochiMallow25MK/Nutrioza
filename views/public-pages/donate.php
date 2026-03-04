<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate - Nutrioza</title>
    <link rel="stylesheet" href="/nutrioza/assets/css/app.css">
    <link rel="stylesheet" href="/nutrioza/assets/css/public.css">
</head>
<body>
    <nav class="navbar">
        <a href="/nutrioza/index.php" class="navbar-brand">Nutrioza</a>
        <ul class="navbar-menu">
            <li><a href="/nutrioza/index.php">Home</a></li>
            <li><a href="/nutrioza/about.php">About</a></li>
            <li><a href="/nutrioza/contact.php">Contact</a></li>
            <li><a href="/nutrioza/donate.php">Donate</a></li>
            <li><a href="/nutrioza/volunteer.php">Volunteer</a></li>
            <li><a href="/nutrioza/login.php">Login</a></li>
        </ul>
    </nav>
    
    <div class="public-header" style="background: linear-gradient(135deg, #84B179 0%, #A2CB8B 100%);">
        <h1>Make a Donation</h1>
        <p>Your contribution helps fight hunger in our community</p>
    </div>
    
    <div class="container" style="padding: 50px 20px;">
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        <div class="donation-form">
            <h2>Donation Form</h2>
            
            <form action="/nutrioza/donate-submit.php" method="POST" id="donationForm" onsubmit="return validateDonationForm()">
                <div class="form-group">
                    <label for="donor_name">Full Name</label>
                    <input type="text" class="form-control" id="donor_name" name="donor_name" required>
                    <div class="error" id="nameError"></div>
                </div>
                
                <div class="form-group">
                    <label for="donor_email">Email Address</label>
                    <input type="email" class="form-control" id="donor_email" name="donor_email" required>
                    <div class="error" id="emailError"></div>
                </div>
                
                <div class="form-group">
                    <label for="donor_phone">Phone Number</label>
                    <input type="tel" class="form-control" id="donor_phone" name="donor_phone" required>
                    <div class="error" id="phoneError"></div>
                </div>
                
                <div class="form-group">
                    <label for="donation_type">Donation Type</label>
                    <select class="form-control" id="donation_type" name="donation_type" onchange="toggleDonationFields()" required>
                        <option value="">Select Type</option>
                        <option value="Food">Food</option>
                        <option value="Money">Money</option>
                    </select>
                </div>
                
                <div id="foodFields" style="display: none;">
                    <div class="form-group">
                        <label for="description">Food Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="quantity">Quantity (kg/units)</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0">
                    </div>
                </div>
                
                <div id="moneyFields" style="display: none;">
                    <div class="form-group">
                        <label for="amount">Amount ($)</label>
                        <input type="number" class="form-control" id="amount" name="amount" min="0" step="0.01">
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Submit Donation</button>
            </form>
        </div>
    </div>
    
    <footer class="footer">
        <p>&copy; 2024 Nutrioza. All rights reserved.</p>
    </footer>
    
    <script>
    function toggleDonationFields() {
        let type = document.getElementById('donation_type').value;
        document.getElementById('foodFields').style.display = type === 'Food' ? 'block' : 'none';
        document.getElementById('moneyFields').style.display = type === 'Money' ? 'block' : 'none';
    }
    
    function validateDonationForm() {
        let name = document.getElementById('donor_name').value;
        let email = document.getElementById('donor_email').value;
        let phone = document.getElementById('donor_phone').value;
        let type = document.getElementById('donation_type').value;
        let isValid = true;
        
        document.getElementById('nameError').innerHTML = '';
        document.getElementById('emailError').innerHTML = '';
        document.getElementById('phoneError').innerHTML = '';
        
        if(name.trim() === '') {
            document.getElementById('nameError').innerHTML = 'Name is required';
            isValid = false;
        }
        
        if(email.trim() === '') {
            document.getElementById('emailError').innerHTML = 'Email is required';
            isValid = false;
        } else if(!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
            document.getElementById('emailError').innerHTML = 'Invalid email format';
            isValid = false;
        }
        
        if(phone.trim() === '') {
            document.getElementById('phoneError').innerHTML = 'Phone is required';
            isValid = false;
        } else if(!phone.match(/^[0-9+\-\s()]{10,}$/)) {
            document.getElementById('phoneError').innerHTML = 'Invalid phone number';
            isValid = false;
        }
        
        if(type === '') {
            alert('Please select donation type');
            isValid = false;
        }
        
        return isValid;
    }
    </script>
</body>
</html>