<html>
	<head>
		<title>Categories</title>
		<link href="{{ asset('css/app.css')}}" rel="stylesheet">
	</head>
	<body>
		<!--Navbar
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
					<li> <a href="{{ url('/store/buy-shopping-cart') }}"> Buy Shopping Cart</a> </li>
					<li> <a href="{{ url('/logout') }}"> Logout </a> </li>
				</ul>
				<div class="nav navbar-nav navbar-right navbar-brand">
						Hello {{ $data['name'] }} 
				</div>
			</div>
		</nav>-->
		<h1>Categories</h1>
		<br />
		<br />
		@if(isset($message))
			<h3>{{ $message }}</h3>
		@endif
		<form method="GET" role="form" action="{{ url('store/categories')}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
 			@foreach($categories as $category)
				<div class="container">
					<div class="row">
						<div class="col-md-3"><h3>{{ $category->name }}</h3><small>{{ $category->description }}</small></div>
					</div>
				</div>
			@endforeach
		</form>

		<div class="container">
		<form method="POST" role="form" action="{{ url('store/categories')}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="cat_name">Add Category</label>
			<input type="text" name="cat_name">
			<label for="cat_description">Description</label>
			<input type="text" name="cat_description">
			<input type="submit" value="Add">
		</form>
		<br />
		<br />
		<br />
		<a href="{{url('logout')}}">Logout</a>
		</div>
	</body>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
</html>