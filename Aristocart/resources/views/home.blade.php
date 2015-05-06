<html>
	<head>
		<title> Home </title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ url('/home') }}">Aristocart</a> 
				</div>
				<ul class="nav navbar-nav">
					<li> <a href="{{ url('/home') }}"> Home </a> </li>
					@if($data['role'] == 'owner')
					<li> <a href="{{ url('/store/categories') }}"> Categories</a> </li>
					<li> <a href="{{ url('/store/products') }}"> Products</a> </li>
					@endif
					<li> <a href="{{ url('/store/product-browsing') }}"> Products Browsing </a> </li>
					<li> <a href="#"> Product Order</a> </li>
					<li> <a href="#"> Buy Shopping Cart</a> </li>
					<li> <a href="{{ url('/logout') }}"> Logout </a> </li>
				</ul>
			</div>
		</nav>

		<center> 
			<h1> <strong> You are logged in! </strong> </h1>
		</center>

		<!-- Bootstrap -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>

 