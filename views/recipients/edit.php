<?php
require_once "../../controllers/RecipientController.php";

$id = $_GET['id'];
$res = RecipientController::list();
while($r=mysqli_fetch_assoc($res)){
if($r['recipient_id']==$id) break;
}
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Edit Recipient</h2>

<form method="post">

<input type="text" name="name" value="<?=$r['name']?>" required>

<select name="type" required>
<option value="NGO" <?=$r['type']=="NGO"?"selected":""?>>NGO</option>
<option value="Kitchen" <?=$r['type']=="Kitchen"?"selected":""?>>Kitchen</option>
<option value="Store" <?=$r['type']=="Store"?"selected":""?>>Store</option>
<option value="Other" <?=$r['type']=="Other"?"selected":""?>>Other</option>
</select>

<input type="text" name="contact_info" value="<?=$r['contact_info']?>">

<textarea name="address"><?=$r['address']?></textarea>

<button type="submit" name="submit">Update</button>

</form>

<?php
if(isset($_POST['submit'])){
RecipientController::update(
$id,
$_POST['name'],
$_POST['type'],
$_POST['contact_info'],
$_POST['address']
);
header("Location:list.php");
}
?>

</body>
</html>