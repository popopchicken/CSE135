<html>
	<head>
		<title>Products Browsing</title>
	</head>
	<body>
		<h1>Products Browsing</h1>
		<br />
		
		<!--Allows the user to search for products-->
			<form method="POST" role="form" name="search_form" action="{{ url('store/products') }}">
				<label for="search">Search</label>
				<input type="text" name="search">
				<input type="hidden" name="action" value="search-browse">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="hidden" name="selected_category" value="{{$data['selected_category']}}">
				<input type="hidden" name="all_categories" value="{{$data['all_categories']}}">
				<input type="submit" value="Search">
			</form>
			<table>
				<tr>
					@foreach($data['products'] as $product)
						<td>
							{{$product->name}}
							{{$product->sku}}
							{{$product->price}}
						</td>
					@endforeach
				</tr>
			</table>

	</body>
</html>