<html>
<head>
  <title></title>
   <link href="<?php echo base_url();?>assets/css/reportsLayout.css" rel="stylesheet">
</head>
<body>
<h1>Vets In Practice</h1>
<h1>Reservation Receipt</h1>
<table class="detail" style="width:100%;margin: 0px; border-top: none;">
<tr>
<td class="label">Date:</td>
<td class="field">
  <?php 
    echo date('l jS \of F Y h:i:s A');
  ?>
</td>
</tr>
<tr>
	<td>
		Customer Name:
		<?php echo $reservations[0]['first_name'] ?>, 
 		<?php echo $reservations[0]['last_name'] ?>
	</td>
</tr>
<tr><td></td></tr>
</tbody>
</table>
<table class="list" style="width: 99%; margin-top: 1em;" id="generatedReportUser">

<tbody>
<tr class="head">
<td class="center" style="width: 10%">Date</td>
<td style="width: 35%">Service Name</td>
<td class="center" style="width: 20%">Customer Name</td>
<td class="right" style="width: 15%;text-align:right;">Price</td>
</tr>
<?php
 foreach ($reservations as $row){
echo'<tr class="list_row">';
echo'<td class="center">'.$row['reserveDate'].' '.$row['reserveTime'].'</td>';
echo'<td class="center">'.$row['service_name'].'</td>';
echo'<td>'.$row['last_name'].', '.$row['first_name'].'</td>';
echo'<td style="text-align:right;">P '.$row['price'].'</td>';
echo'</tr>';
  }
?>
</tbody>

</table>


</body>
</html>
