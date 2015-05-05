<html>
	<head>
		<title>Products</title>
	</head>
	<body>
		@if($data['role'] == 'owner')
		<h1>Products</h1>
		<br />
		<br />
		<div id="categories" style="float:left">
			<ul>
				@foreach($data['categories'] as $key => $category)
					<li><a href="products?selected_category={{ $key }}">{{ $category }}</a> <?=($data['selected_category'] == $key ? ' ***' : '')?></li>
				@endforeach
			</ul>	
		</div>
			<div id="add-product" style="float:left; margin-left:20px">
				<form method="POST" role="form" action="{{ url('sign-up') }}">
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
							@foreach($data['categories'] as $key => $category)
								<option value="{{ $key }}">{{ $category }}</option>
							@endforeach
						</select>
						<br />
						<input type="submit" value="Add Product">
				</form>
			</div>
		@else
			<h2>This page is available to owners only</h2>
		@endif
	</body>
</html>
