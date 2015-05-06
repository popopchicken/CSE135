<html>
	<head>
		<title> Home </title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	</head>
	<body>
		You are logged in!
		<a class="navbar-brand" href="#">Aristocart</a> <br />
		Home <br />
		<a href="{{ url('/store/categories') }}"> Categories</a> <br/>
		<a href="{{ url('/store/products') }}"> Products</a> <br />
		<a href="{{ url('/store/product-browsing') }}"> Products Browsing </a> <br />
		<a href="#"> Product Order</a> <br />
		<a href="#"> Buy Shopping Cart</a> <br />
		<a href="#"> Confirmation</a> <br />
		<a href="{{ url('/logout') }}"> Logout </a> <br/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>
