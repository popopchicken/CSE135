<html>
	<head>
		<title>Categories</title>
		<link href="{{ asset('css/app.css')}}" rel="stylesheet">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="{{ url('/home') }}">Aristocart</a> 
				</div>
				<ul class="nav navbar-nav">
					<li> <a href="{{ url('/home') }}"> Home </a> </li>
					@if($data['role'] == 'owner')
					<li> <a href="{{ url('/store/categories') }}"> Categories</a> </li>
					<li> <a href="{{ url('/store/products') }}"> Products</a> </li>
					@endif
					<li> <a href="{{ url('/store/product-browsing') }}"> Products Browsing </a> </li>
					<li> <a href="{{ url('/store/product-order') }}"> Product Order</a> </li>
					<li> <a href="{{ url('/store/buy-shopping-cart') }}"> Buy Shopping Cart</a> </li>
					<li> <a href="{{ url('/logout') }}"> Logout </a> </li>
				</ul>
				<div class="nav navbar-nav navbar-right navbar-brand">
						Hello {{ $data['name'] }} 
				</div>
			</div>
		</nav>
		@if($data['role'] == 'owner')
		<h1>Categories</h1>
		<br />
		@if(isset($data['errors']))
			<div class="alert alert-danger" role="alert">{{ $data['errors'] }}</div>
		@endif
		<div class="container">
			@foreach($data['categories'] as $key => $category)
			<div class="row" style="border-bottom: solid">
				<div class="col-md-3" id="categories">
					<h3>{{ $category->name }}</h3><small>{{ $category->description }}</small>
				</div>
				<div class="col-md-3">
					@if(in_array($category->name, $data['hasProducts']))
						<p>Contains Products</p>
					@else
					<form method="POST" role="form" action="{{ url('store/categories') }}">
						<input type="hidden" name="action" value="deleteCategory">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="cat_id" value="{{($category->id) }}">
						<input type="hidden" name="cat_name" value="{{($category->name)}}">
						<input type="submit" value="Delete">
					</form>
					@endif
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