<!DOCTYPE html>
<html>

<head>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>

<body>
  <p><strong>Congratulations {{ $user->name }}! Your checkout is Successful!</strong></p>

  <p>Here's your order information:</p>

  <table>
    <tr>
      <th>Product</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
    @foreach ($checkoutProduct as $product)
    <tr>
      <td>{{ $product->product->name }}</td>
      <td>{{ $product->quantity }}</td>
      <td>${{ $product->price }}</td>
    </tr>
    @endforeach
  </table>

  <p><strong>Total: ${{ $checkout->total_price }}</strong></p>

</body>

</html>