<html>
	<head>
		<title>Thank You!</title>
	</head>
	<body>
		<h1>Confirmation Page</h1>
		<br />
		<h3>Your order has been completed, thank you for your business!</h3>
		You purchased:
		<br />
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
	</body>
</html>