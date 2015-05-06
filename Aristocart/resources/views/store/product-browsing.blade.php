<html>
	<head>
		<title>Products Browsing</title>
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
					<li> <a href="{{ url('/store/buy-shopping-cart') }}"> Buy Shopping Cart</a> </li>
					<li> <a href="{{ url('/logout') }}"> Logout </a> </li>
				</ul>
				<div class="nav navbar-nav navbar-right navbar-brand">
						Hello {{ $data['name'] }} 
				</div>
			</div>
		</nav>
		<h1>Products Browsing</h1>
		<br />
		
		<!--Allows the user to search for products-->
			<form method="POST" role="form" name="search_form" action="{{ url('store/product-browsing') }}">
				<label for="search">Search</label>
				<input type="text" name="search">
				<input type="hidden" name="action" value="search">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="selected_category" value="{{$data['selected_category']}}">
				<input type="hidden" name="all_categories" value="{{$data['all_categories']}}">
				<input type="submit" value="Search">
			</form>
			<div id="categories" style="float:left">
				<ul>
						<li><a href="product-browsing?all_categories=1">All Categories</a>{{ ($data['all_categories'] == 1 ? '***' : '') }}</li>
					@foreach($data['categories'] as $key => $category)
						<li><a href="product-browsing?all_categories=0&amp;selected_category={{ $key }}">{{ $category }}</a> <?=($data['selected_category'] == $key ? ' ***' : '')?></li>
					@endforeach
				</ul>	
			</div>
			<div id="products">
				<table>
					<tr>
						@foreach($data['products'] as $product)
							<td style="padding:15px">
								{{$product->name}}
								<br />
								SKU: {{$product->sku}}
								<br />
								Price: ${{$product->price}}
								<br />
								<form method="POST" role="form" action="{{ url('store/product-order') }}">
									<input type="hidden" name="action" value="add-to-cart">
									<input type="hidden" name="productId" value="{{$product->product_id}}">
									<input type="hidden" name="price" value="{{$product->price}}">
 									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="submit" value="Add To Cart">
								</form>
							</td>
						@endforeach
					</tr>
				</table>
			</div>
		<!-- Bootstrap -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	</body>
</html>