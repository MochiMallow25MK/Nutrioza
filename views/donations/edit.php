<?php
require_once "../../controllers/DonationController.php";

$id=$_GET['id'];
$res=DonationController::list();

while($d=mysqli_fetch_assoc($res)){
if($d['donation_id']==$id) break;
}
?>

<html>

<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>

<body>

<form method="post">

<input type="text" name="donor_name" value="<?=$d['donor_name']?>" required>

<input type="email" name="donor_email" value="<?=$d['donor_email']?>" required>

<input type="text" name="donor_phone" value="<?=$d['donor_phone']?>">

<select name="donation_type">
<option value="Food" <?=$d['donation_type']=="Food"?"selected":""?>>Food</option>
<option value="Money" <?=$d['donation_type']=="Money"?"selected":""?>>Money</option>
</select>

<textarea name="description"><?=$d['description']?></textarea>

<input type="number" name="quantity" value="<?=$d['quantity']?>">

<input type="number" step="0.01" name="amount" value="<?=$d['amount']?>">

<select name="status">
<option value="Pending" <?=$d['status']=="Pending"?"selected":""?>>Pending</option>
<option value="Approved" <?=$d['status']=="Approved"?"selected":""?>>Approved</option>
<option value="Rejected" <?=$d['status']=="Rejected"?"selected":""?>>Rejected</option>
</select>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){

DonationController::update(
$id,
$_POST['donor_name'],
$_POST['donor_email'],
$_POST['donor_phone'],
$_POST['donation_type'],
$_POST['description'],
$_POST['quantity'],
$_POST['amount'],
$_POST['status']
);

header("Location:list.php");
}
?>

</body>
</html>