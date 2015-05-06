<html>
	<head>
		<title>Product Add {{ $data['result'] }}</title>
	</head>
	<body>
		<h1> Product Add {{ $data['result'] }}</h1>
		<br />
		@if(!empty($data['errors']))
		<!--<ul>
			@foreach ($data['errors'] as $error)
				<li>{{ $error }}</li>
			@endforeach 
		</ul> -->
		<h2> Failure to insert new product. </h2>
		@endif
		<br />
		<a href='products'>Back to Products</a>
	</body>
</html>