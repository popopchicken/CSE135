<html>
	<head>
		<title>Buy Shopping Cart</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	</head>
	<body>
		<!--Navbar-->
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
					<li> <a href="{{ url('/store/product-order') }}"> Product Order</a> </li>
					<li> <a href="{{ url('store/buy-shopping-cart') }}"> Buy Shopping Cart</a> </li>
					<li> <a href="{{ url('/logout') }}"> Logout </a> </li>
				</ul>
				<div class="nav navbar-nav navbar-right navbar-brand">
						Hello {{ $data['name'] }} 
				</div>
			</div>
		</nav>
		<h1>Buy Shopping Cart</h1>
		<br />
		
		<div id="cart">
			<table>
				@foreach($data['products'] as $product)
					<tr>
						<td> {{$product->name}}</td>
						<td> ${{$product->price}}</td>
						<td> {{$product->quantity}}</td>
					</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td>Total: {{$data['cart_total']}} </td>
				</tr>
			</table>

			<form method="POST" role="form" name="purchase_cart" action="{{ url('store/buy-shopping-cart') }}">
				<label for="credit_card">Credit Card:</label>
				<input type="text" name="credit_card">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="Purchase">
			</form>
		</div>
		<!-- Bootstrap -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>