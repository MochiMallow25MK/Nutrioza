<?php
require_once "../../models/FoodItemModel.php";
$items=FoodItemModel::getAll();
?>
<html>
<head>
<link rel="stylesheet" href="../../assets/css/table.css">
</head>
<body>
<h2>Stock Report</h2>
<table>
<tr><th>Item</th><th>Category</th><th>Supplier</th><th>Quantity</th><th>Expiry</th></tr>
<?php while($i=mysqli_fetch_assoc($items)){ ?>
<tr>
<td><?=$i['name']?></td>
<td><?=$i['category_name']?></td>
<td><?=$i['supplier_name']?></td>
<td><?=$i['quantity']?></td>
<td><?=$i['expiry_date']?></td>
</tr>
<?php } ?>
</table>
</body>
</html>