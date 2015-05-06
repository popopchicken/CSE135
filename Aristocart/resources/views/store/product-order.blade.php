<html>
	<head>
		<title>Products Order</title>
	</head>
	<body>
		<h1>Products Order</h1>
		<br />
		
		<div id="cart">
			<table>
				@foreach($data['products'] as $product)
					<tr>
						<td> {{$product->name}}</td>
						<td> ${{$product->price}}</td>
						<td> {{$product->quantity}}</td>
					</tr>
				@endforeach
				<tr>
					<td></td>
					<td></td>
					<td>Total: {{$data['cart_total']}} </td>
				</tr>
			</table>
		</div>
		@if($data['new_item']['productId'] > 0)
		<div id="pending_item">
			<table>
				<tr>
					<td>{{$data['new_item']['name']}}</td>
					<td>{{$data['new_item']['price']}}</td>
					<td>
						<form method="POST" role="form" name="confirm_add" action="{{ url('store/product-order') }}">
						<label for="quantity">Add Quantity:</label>
						<input type="text" name="quantity">
						<input type="hidden" name="action" value="confirm-add">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="productId" value="{{$data['new_item']['productId']}}">
						<input type="hidden" name = "price" value="{{$data['price']}}">
						<input type="submit" value="Add to Cart">
						</form>
					</td>
				</tr>
			</table>
		</div>
		@endif
	</body>
</html>