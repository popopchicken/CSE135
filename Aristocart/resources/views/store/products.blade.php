<html>
	<head>
		<title>Products</title>
	</head>
	<body>
		@if($data['role'] == 'owner')
		<h1>Products</h1>
		<br />
			<form method="POST" role="form" action="{{ url('store/products') }}">
				<label for="search">Search</label>
				<input type="text" name="search">
				<input type="hidden" name="action" value="search">
			</form>
		<br />
		<div id="categories" style="float:left">
			<ul>
					<li><a href="products?all_categories=1">All Categories</a>{{ ($data['selected_category'] == -1 ? '***' : '') }}</li>
				@foreach($data['categories'] as $key => $category)
					<li><a href="products?selected_category={{ $key }}">{{ $category }}</a> <?=($data['selected_category'] == $key ? ' ***' : '')?></li>
				@endforeach
			</ul>	
		</div>
			<div id="add-product" style="float:left; margin-left:20px">
				<form method="POST" role="form" action="{{ url('store/products') }}">
					<input type="hidden" name="action" value="addProduct">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<label for="name">Item Name</label>
						<input type="text" name="name">
						<br />
						<label for="sku">SKU Number</label>
						<input type="text" name="sku">
						<br />
						<label for="price">Price</label>
						<input type="text" name="price">
						<br />
						<label for="category">Category</label>
						<select name="category">
								<option value="-1">---Select One---</option>
							@foreach($data['categories'] as $key => $category)
								<option value="{{ $key }}">{{ $category }}</option>
							@endforeach
						</select>
						<br />
						<input type="submit" value="Add Product">
				</form>
				<table style="width:80%">
					<tr>
						@foreach($data['products'] as $product)
							<td>
								<form method="POST" role="form" action="{{ url('store/products') }}">
									<input type="hidden" name="action" value="update">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="productId" value="{{$product->id}}">
									<label for="name">Item Name</label>
									<input type="text" name="name" value="{{$product->name}}">
									<br />
									<label for="sku">SKU Number</label>
									<input type="text" name="sku" value="{{$product->sku}}">
									<br />
									<label for="price">Price</label>
									<input type="text" name="price" value="{{$product->price}}">
									<br />
									<label for="category">Category</label>
									<select name="category">
										<option value="-1">---Select One---</option>
									@foreach($data['categories'] as $key => $category)
										<option value="{{ $key }}" selected="{{($key == $product->category_id ? 'selected' : '')}}">{{ $category }}</option>
									@endforeach
									</select>
									<br />
									<input type="submit" value="Update">
								</form>
								<form method="POST" role="form" action="{{url('store/products') }}">
									<input type="hidden" name="action" value="delete">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="hidden" name="productId" value="{{$product->id}}">
									<input type="submit" value="Delete">
								</form>
							</td>
							@if($data['count'] == 4)
								</tr>
								<tr>
								<? $data['count'] = 0; ?>
							@endif
							<? $data['count']++; ?>
						@endforeach
					</tr>
				</table>
			</div>
		@else
			<h2>This page is available to owners only</h2>
		@endif
	</body>
</html>
