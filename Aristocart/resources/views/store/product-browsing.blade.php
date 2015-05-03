<html>
	<head>
		<title>Products Browsing</title>
	</head>
	<body>
		<h1>Products Browsing</h1>
		<br />

		@foreach ($errors->all() as $error)
        <p class="error">{{ $error }}</p>
    	@endforeach
		
		<!--Allows the user to search for products-->
		<form method="POST" role="search" action="{{ search() }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="search">Search</label>
			<input type="text" name="search" placeholder="Search for Products">
			<br />
			<br />
			<input type="submit" value="Search">
		</form>
	</body>
</html>