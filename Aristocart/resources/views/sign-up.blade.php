<html>
	<head>
		<title>Sign Up</title>
	</head>
	<body>
		<h1> Sign Up </h1>
		<br />
		<form method="POST" role="form" action="{{ url('sign-up') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<label for="user_name">User Name</label>
			<input type="text" name="user_name">
			<br />
			<br />


			<label for="role">Role</label>
			<select name="role">
				<option value="owner">Owner</option>
				<option value="customer">Customer</option>
			</select>
			<br />
			<br />


			<label for="age">Age</label>
			<input type="text" name="age">
			<br />
			<br />

			
			<label for="state">State</label>
			<select name="state">
				<option value="CA">California</option>
				<option value="customer">Arizona</option>
			</select>
			<br />
			<br />
			<input type="submit" value="Sign Up">
		</form>
	</body>
</html>
