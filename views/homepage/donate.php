<?php
require_once "../../controllers/DonationController.php";
?>

<html>

<head>
<link rel="stylesheet" href="../../assets/css/public.css">
<script src="../../assets/js/validation.js"></script>
</head>

<body>

<h2>Donate Form</Form></h2>

<form method="post" onsubmit="return formValidate()">

<input type="text" name="donor_name" placeholder="Name" required>

<input type="email" name="donor_email" placeholder="Email" required>

<input type="text" name="donor_phone" placeholder="Phone">

<select name="donation_type" required>
<option value="">Type</option>
<option value="Food">Food</option>
<option value="Money">Money</option>
</select>

<textarea name="description" placeholder="Description"></textarea>

<input type="number" name="quantity" placeholder="Food Quantity">

<input type="number" step="0.01" name="amount" placeholder="Money Amount">

<button type="submit" name="submit">Submit Donation</button>

</form>

<?php
if(isset($_POST['submit'])){

DonationController::create(
$_POST['donor_name'],
$_POST['donor_email'],
$_POST['donor_phone'],
$_POST['donation_type'],
$_POST['description'],
$_POST['quantity'],
$_POST['amount']
);

echo "<script>alert('Donation submitted');</script>";
}
?>

</body>
</html>