<html>
	<head>
		<title>Categories</title>
	</head>
	<body>
		<h1>Categories</h1>
		<br />
		<br />
		<a href="#">Category 1</a>
		<br />
		<br />
		<a href="#">Category 2</a>
		<br />
		<br />
		<a href="#">Category 3</a>
		<br />
		<br />
		<form method="POST" role="form" action="{{ url('store/categories')}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="add_category">
			<input type="text" name="add_category">
			<input type="submit" value="Add Category">
		</form>
		<br />
		<br />
		<br />
		<a href="{{url('logout')}}">Logout</a>
	</body>
</html>