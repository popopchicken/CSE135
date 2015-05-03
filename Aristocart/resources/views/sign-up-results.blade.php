<html>
	<head>
		<title>Sign Up {{ $data['result'] }}</title>
	</head>
	<body>
		<h1> Sign Up {{ $data['result'] }}</h1>
		<br />
		@if(!empty($data['errors']))
		<ul>
			@foreach ($data['errors'] as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
		@endif
	</body>
</html>
