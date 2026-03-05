<?php
require_once "../../models/SupplierModel.php";
$suppliers=SupplierModel::getAll();
?>
<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>
<h2>Supplier Report</h2>
<table>
<tr><th>ID</th><th>Name</th><th>Contact</th><th>Address</th></tr>
<?php while($s=mysqli_fetch_assoc($suppliers)){ ?>
<tr>
<td><?=$s['supplier_id']?></td>
<td><?=$s['name']?></td>
<td><?=$s['contact_info']?></td>
<td><?=$s['address']?></td>
</tr>
<?php } ?>
</table>
</body>
</html>