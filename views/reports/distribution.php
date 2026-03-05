<?php
require_once "../../models/DistributionModel.php";
$distributions=DistributionModel::getAll();
?>
<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>
<h2>Distribution History</h2>
<table>
<tr><th>ID</th><th>Recipient</th><th>Status</th><th>Approved By</th><th>Date</th></tr>
<?php while($d=mysqli_fetch_assoc($distributions)){ ?>
<tr>
<td><?=$d['distribution_id']?></td>
<td><?=$d['recipient_name']?></td>
<td><?=$d['status']?></td>
<td><?=$d['approved_name']?></td>
<td><?=$d['distribution_date']?></td>
</tr>
<?php } ?>
</table>
</body>
</html>