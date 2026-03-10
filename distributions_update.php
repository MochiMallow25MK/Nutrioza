<?php
session_start();
require 'config.php';

if (isset($_GET['distribution_id'])) {
    $distribution_id = (int)$_GET['distribution_id'];
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $status = mysqli_real_escape_string($link, $_POST['status']);
        $distribution_date = mysqli_real_escape_string($link, $_POST['distribution_date']);
        
        $sql = "UPDATE distributions SET status='$status', distribution_date='$distribution_date' WHERE distribution_id=$distribution_id";
        
        if (mysqli_query($link, $sql)) {
            header("Location: distributions_index.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($link);
        }
    }
    
    $result = mysqli_query($link, "SELECT * FROM distributions WHERE distribution_id=$distribution_id");
    $row = mysqli_fetch_assoc($result);
    
    if (!$row) {
        echo "Distribution not found. <a href='distributions_index.php'>Back</a>";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Distribution</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="form-container">
        <h2>Update Distribution</h2>
        <form method="POST">
            <div class="form-group">
                <label>Status</label>
                <select name="status" required>
                    <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Approved" <?= $row['status'] == 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Delivered" <?= $row['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                </select>
            </div>
            <div class="form-group">
                <label>Distribution Date</label>
                <input type="date" name="distribution_date" value="<?= $row['distribution_date'] ?>" required>
            </div>
            <button type="submit">Update Distribution</button>
        </form>
        <a href="distributions_index.php" class="back-link">Back to Distributions</a>
    </div>
</body>
</html>
<?php } ?>