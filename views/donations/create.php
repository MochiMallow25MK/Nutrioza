<?php
require_once "../../controllers/DonationController.php";
?>

<html>

<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>

<body>

<form method="post">

<input type="text" name="donor_name" placeholder="Name" required>

<input type="email" name="donor_email" placeholder="Email" required>

<input type="text" name="donor_phone" placeholder="Phone">

<select name="donation_type" required>
<option value="Food">Food</option>
<option value="Money">Money</option>
</select>

<textarea name="description"></textarea>

<input type="number" name="quantity" placeholder="Quantity">

<input type="number" step="0.01" name="amount" placeholder="Amount">

<select name="status">
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>
</select>

<button type="submit" name="submit">Create</button>

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

header("Location:list.php");
}
?>

</body>
</html>