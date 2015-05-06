<html>
	<head>
		<title>Categories</title>
		<link href="{{ asset('css/app.css')}}" rel="stylesheet">
	</head>
	<body>
		@if($data['role'] == 'owner')
		<h1>Categories</h1>
		<br />
		@if(isset($data['errors']))
			<div class="alert alert-danger" role="alert">{{ $data['errors'] }}</div>
		@endif
		<div class="container">
			@foreach($data['categories'] as $key => $category)
			<div class="row">
				<div class="col-md-3" id="categories">
					<h3>{{ $category->name }}</h3><small>{{ $category->description }}</small>
				</div>
				<div class="col-md-3">
					<form method="POST" role="form" action="{{ url('store/categories') }}">
						<input type="hidden" name="action" value="deleteCategory">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="cat_id" value="{{($category->id) }}">
						<input type="hidden" name="cat_name" value="{{($category->name)}}">
						@foreach($data['catsWithProducts'] as $key => $allCats)
							@if($category->id == $allCats->category_id)
								<p>Contains Products</p>
							@else
								<input type="submit" value="Delete">
							@endif
						@endforeach
					</form>
					<form method="POST" role="form" action="{{ url('store/categories') }}">
						<input type="hidden" name="action" value="updateCategory">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="cat_id" value="{{($category->id) }}">
						<label for="name">Category Name</label>
						<input type="text" name="cat_name" value="{{$category->name}}">
						<label for="name">Category Description</label>
						<input type="text" name="cat_description" value="{{$category->description}}">
						<input type="submit" value="Update">
					</form>
				</div>
			</div>
			@endforeach
			<div class="row" id="add-categories">
				<form method="POST" role="form" action="{{ url('store/categories') }}">
					<input type="hidden" name="action" value="addCategory">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<label for="cat_name">Add Category</label>
					<input type="text" name="cat_name">
					<label for="cat_description">Description</label>
					<input type="text" name="cat_description">
					<input type="submit" value="Add">
				</form>
			</div>
			<div class="row">
				<a href="{{url('logout')}}">Logout</a>
			</div>
		</div>
		@else
			<h2>This page is available to owners only</h2>
			<a href="{{url('logout')}}">Logout</a>
		@endif
	</body>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
</html>