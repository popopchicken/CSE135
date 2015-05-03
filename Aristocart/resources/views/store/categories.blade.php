<html>
	<head>
		<title>Categories</title>
	</head>
	<body>
		<h1>Categories</h1>
		<br />
		<br />
		
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
	</body>
</html>