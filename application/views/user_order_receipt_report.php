<html>
<head>
  <title></title>
   <link href="<?php echo base_url();?>assets/css/reportsLayout.css" rel="stylesheet">

   <style>
      table th{
        border-width: 1px;
        border-top: 1px;
        border-bottom: 1px;
        border-right: 0px;
        border-left: 0px;
        border-style: solid;
        border-color:#000000;
      }
   </style>
</head>
<body>
<h1>Receipt # <?php echo $list_of_orders[0]['batchOrderId'] ?></h1>
<table class="detail" style="width:100%;margin: 0px; border-top: none;">

</tbody>
</table>


 <table class="table table-hover" style="width:100%;">
            <thead>
              <tr>
                <th style="width:40%;">Product Name</th>
                <th style="width:20%;text-align:right;padding-right:15px;">Price</th>
                <th style="width:20%;text-align:right;padding-right:15px;">Amount</th>
                <th style="width:20%;text-align:right;padding-right:15px;">Total Price</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($list_of_orders as $row){

                echo "<tr>";
                echo "<td class='vert productName'>".$row['product_name']."</td>";
                echo "<td style='text-align:right;padding-right:15px;' class='vert productPrice rightalignPadding'>P <span>".$row['product_price']."</span></td>";
                echo "<td style='text-align:right;padding-right:15px;' class='vert orderAmount rightalignPadding'>".$row['productAmount']."</td>";
                echo "<td style='text-align:right;padding-right:15px;' class='vert productTotal rightalignPadding'>P <span>".$row['totalPrice']."</span></td>";
                echo "</tr>";

                }
              ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3"></td>
                <td style='text-align:right;padding-right:15px;'><p style="text-align:left;">TOTAL</p><span style="">P<?php echo $row['totalAll'] ?></span></td>
                <td></td>
              </tr>
            </tfoot>
          </table>


</body>
</html>

