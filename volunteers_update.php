<?php
session_start();
require 'config.php';

if (isset($_GET['volunteer_id'])) {
    $volunteer_id = (int)$_GET['volunteer_id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $full_name = mysqli_real_escape_string($link, $_POST['full_name']);
        $email = mysqli_real_escape_string($link, $_POST['email']);
        $phone = mysqli_real_escape_string($link, $_POST['phone']);
        $availability = mysqli_real_escape_string($link, $_POST['availability']);
        $skills = mysqli_real_escape_string($link, $_POST['skills']);
        $status = mysqli_real_escape_string($link, $_POST['status']);
        
        $sql = "UPDATE volunteers SET full_name='$full_name', email='$email', phone='$phone', availability='$availability', skills='$skills', status='$status' WHERE volunteer_id=$volunteer_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: volunteers_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM volunteers WHERE volunteer_id=$volunteer_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Volunteer not found. <a href='volunteers_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Volunteer</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Volunteer</h2>
        <form method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" value="<?= $row['full_name'] ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $row['email'] ?>" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?= $row['phone'] ?>">
            </div>
            <div class="form-group">
                <label>Availability</label>
                <textarea name="availability" rows="2" required><?= $row['availability'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Skills</label>
                <textarea name="skills" rows="3" required><?= $row['skills'] ?></textarea>
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Rejected" <?= $row['status'] == 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
            </div>
            <button type="submit">Update Volunteer</button>
        </form>
        <a href="volunteers_index.php" class="back-link">Back to Volunteers</a>
    </div>
</body>
</html>
<?php } ?>