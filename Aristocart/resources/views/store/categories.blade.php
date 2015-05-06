<html>
	<head>
		<title>Categories</title>
		<link href="{{ asset('css/app.css')}}" rel="stylesheet">
	</head>
	<body>
		<h1>Categories</h1>
		<br />
		<br />
		@if(isset($message))
			<h3>{{ $message }}</h3>
		@endif
		<form method="GET" role="form" action="{{ url('store/categories')}}">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
 			@foreach($categories as $category)
				<div class="container">
					<div class="row">
						<div class="col-md-3"><h3>{{ $category->name }}</h3><small>{{ $category->description }}</small></div>
					</div>
				</div>
			@endforeach
		</form>

		<div class="container">
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
		</div>
	</body>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
</html>