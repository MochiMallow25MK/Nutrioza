<html>
<head>
<link rel="stylesheet" href="../../assets/css/public.css">
<title>Contact Us</title>
<script src="../../assets/js/validation.js"></script>
</head>
<body style="background-color:#FEFAE0;">
<h1 style="color:#31694E;">Contact Us</h1>
<form method="post" onsubmit="return formValidate()">
<input type="text" name="name" placeholder="Your Name" required>
<input type="email" name="email" placeholder="Your Email" required>
<textarea name="message" placeholder="Your Message" required></textarea>
<button type="submit" name="submit">Send Message</button>
</form>
<?php
if(isset($_POST['submit'])){
$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];
// In real project, send email or store in DB
echo "<p style='color:#A4B465;'>Thank you $name! Your message has been received.</p>";
}
?>
<a href="public.php" style="color:#84B179;">Back to Home</a>
</body>
</html>