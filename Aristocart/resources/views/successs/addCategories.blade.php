<<!DOCTYPE html>
<html>
<head>
	<title>Success!</title>
</head>
<body>
	You've successfully added a new category!

	Your added category:
	<div class="container">
		<div class="row">
			<div class="col-md-3"><h3>{{ $category->cat_name }}</h3><small>{{ $category->cat_description }}</small></div>
		</div>
	</div>

	<br />
	<br />
	<br />
	<a href="{{url('store/categories')}}">Back to Categories</a>
</body>
</html>


