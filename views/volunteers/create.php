<?php
require_once "../../controllers/VolunteerController.php";
require_once "../../models/UserModel.php";

$users = UserModel::getAll();
?>

<html>
<head>
<link rel="stylesheet" href="../../assets/css/form.css">
</head>
<body>

<h2>Add Volunteer</h2>

<form method="post">

<input type="text" name="full_name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email" required>

<input type="text" name="phone" placeholder="Phone">

<textarea name="availability" placeholder="Availability"></textarea>

<textarea name="skills" placeholder="Skills"></textarea>

<select name="status" required>
<option value="Pending">Pending</option>
<option value="Approved">Approved</option>
<option value="Rejected">Rejected</option>
</select>

<select name="reviewed_by">
<option value="">Reviewed By</option>
<?php
while($u=mysqli_fetch_assoc($users)){
echo "<option value='{$u['user_id']}'>{$u['name']}</option>";
}
?>
</select>

<button type="submit" name="submit">Create</button>

</form>

<?php
if(isset($_POST['submit'])){
VolunteerController::create(
$_POST['full_name'],
$_POST['email'],
$_POST['phone'],
$_POST['availability'],
$_POST['skills'],
$_POST['status'],
$_POST['reviewed_by']
);
header("Location:list.php");
}
?>

</body>
</html>