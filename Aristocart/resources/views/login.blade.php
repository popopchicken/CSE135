<html>
	<head>
		<title>Login Page</title>
	</head>
	<body>
		<h1>Login</h1>
		<br />

		@foreach ($errors->all() as $error)
        <p class="error">{{ $error }}</p>
    	@endforeach
		
		<form method="POST" role="form" action="{{ url('login') }}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<label for="user_name">User Name</label>
			<input type="text" name="user_name">
			<br />
			<br />
			<input type="submit" value="Login">
		</form>
	</body>
</html>