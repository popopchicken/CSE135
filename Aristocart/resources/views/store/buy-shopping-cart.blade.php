<html>
	<head>
		<title>Buy Shopping Cart</title>
	</head>
	<body>
		<h1>Buy Shopping Cart</h1>
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

			<form method="POST" role="form" name="purchase_cart" action="{{ url('store/buy-shopping-cart') }}">
				<label for="credit_card">Credit Card:</label>
				<input type="text" name="credit_card">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" value="Purchase">
			</form>
		</div>
	</body>
</html>