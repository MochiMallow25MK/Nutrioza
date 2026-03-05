<html>

<head>
<link rel="stylesheet" href="../../assets/css/login.css">
<script src="../../assets/js/validation.js"></script>
</head>

<body>

<form method="post" action="../../controllers/AuthController.php" onsubmit="return loginValidate()">

<h2>Nutrioza Login</h2>

<input type="email" id="email" name="email" placeholder="Email">

<input type="password" id="password" name="password" placeholder="Password">

<button type="submit">Login</button>

<a href="../dashboard/public.php">Continue as Public User</a>

</form>

</body>

</html>