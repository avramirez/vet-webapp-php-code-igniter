
<thead>
  <tr>
    <th style="width:270px;">Product Name</th>
    <th style="text-align:right;padding-right:15px;">Price</th>
    <th style="text-align:right;padding-right:15px;">Amount</th>
    <th style="text-align:right;padding-right:15px;">Total Price</th>
  </tr>
</thead>
<tbody>
  <?php foreach ($list_of_orders as $row){

    echo "<tr>";
    echo "<td class='vert productName'>".$row['product_name']."</td>";
    echo "<td class='vert productPrice rightalignPadding'>&#8369; <span>".$row['product_price']."</span></td>";
    echo "<td class='vert orderAmount rightalignPadding'>".$row['productAmount']."</td>";
    echo "<td class='vert productTotal rightalignPadding'>&#8369; <span>".$row['totalPrice']."</span></td>";
    echo "</tr>";

    }
  ?>
</tbody>
