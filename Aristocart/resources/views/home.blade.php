<html>
	<head>
		<title> Home </title>
	</head>
	<body>
		You are logged in!
		<a class="navbar-brand" href="#">Aristocart</a> <br />
		Home <br />
		<a href="{{ url('/store/categories') }}"> Categories </a> <br/>
		<a href="{{ url('/store/products') }}"> Products </a> <br />
		<a href="{{ url('/store/product-browsing}}"> Products Browsing </a> <br />
		<a href="#"> Product Order </a> <br />
		<a href="#"> Buy Shopping Cart </a> <br />
		<a href="#"> Confirmation </a> <br />
		<a href="{{ url('/logout') }}"> Logout </a> <br/>
	</body>
</html>
