<html>
	<head>
		<title>Products Browsing</title>
	</head>
	<body>
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
								<form method="POST" role="form" name="search_form" action="{{ url('store/product-order') }}">
									<input type="hidden" name="action" value="add-to-cart">
									<input type="hidden" name="productId" value="{{$product->product_id}}">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="submit" value="Add To Cart">
								</form>
							</td>
						@endforeach
					</tr>
				</table>
			</div>
	</body>
</html>