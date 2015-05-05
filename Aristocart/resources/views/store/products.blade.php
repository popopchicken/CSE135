<html>
	<head>
		<title>Products</title>
	</head>
	<body>
		@if($data['role'] == 'owner'){
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
		@else
			<h2>This page is available to owners only</h2>
		@endif
	</body>
</html>
