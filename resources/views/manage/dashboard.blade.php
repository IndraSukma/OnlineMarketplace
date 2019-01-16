<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Dashboard</title>
		<link rel="stylesheet" href="">
	</head>
	<body>
		<ul>
			<li><a href="{{ route('user.index') }}">Profile</a></li>
			<li><a href="{{ route('address.index') }}">Address</a></li>
			<li><a href="{{ route('products.index') }}">Products</a></li>
			<li><a href="{{ route('productCategories.index') }}">Product Categories</a></li>
		</ul>
	</body>
</html>