<?php
require_once "../../controllers/VolunteerController.php";
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
<script src="../../assets/js/validation.js"></script>
</head>
<body>

<h2>Volunteer Form</h2>

<form method="post" onsubmit="return formValidate()">

<input type="text" name="full_name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="phone" placeholder="Phone">

<textarea name="availability" placeholder="Availability"></textarea>

<textarea name="skills" placeholder="Skills"></textarea>

<button type="submit" name="submit">Submit</button>

</form>

<?php
if(isset($_POST['submit'])){
VolunteerController::create(
$_POST['full_name'],
$_POST['email'],
$_POST['phone'],
$_POST['availability'],
$_POST['skills']
);
echo "<p>Application submitted successfully!</p>";
}
?>

</body>
</html>