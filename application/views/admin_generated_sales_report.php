<html>
<head>
  <title></title>
   <link href="<?php echo base_url();?>assets/css/reportsLayout.css" rel="stylesheet">
</head>
<body>
<h1>Sales Report (<?php echo $reportMode; ?>)</h1>
<p>
	From :<?php echo $reportDateFrom; ?>
</p>
<p>
	To: <?php echo $reportDateto; ?>
</p>
<!-- <table class="detail" style="width:100%;margin: 0px; border-top: none;">
<tr>
<td class="label">From:</td>
<td class="field">
<?php
  // echo $reportDateFrom;
?>
</td>
<td class="label">To:</td>
<td class="field">
<?php
  // echo $reportDateto;
?>
</td>

</tbody>
</table> -->
<table class="list" style="width: 99%; margin-top: 1em;" id="generatedReportUser">

<tbody><tr class="head">
<td class="center" style="width: 15%">
	<?php
		if($reportMode=='Daily'){
			echo 'Date';		
		}else if($reportMode=='Weekly'){
			echo 'Week';
		}
	?>
	
</td>
<td style="width:30%;text-align:right;padding-right:20px;">Total Sales</td>

</tr>
<?php
$allTotal=0;
$counter =0;
 foreach ($sales as $row){
 	$allTotal =$allTotal + $row['saleGross'];
echo'<tr class="list_row">';
if($reportMode=='Daily'){
			echo'<td class="center">'.$row['saleDate'].'</td>';
}else if($reportMode=='Weekly'){
			echo'<td class="center">'.$row['saleDate'].'</td>';
}

echo'<td style="text-align:right;padding-right:20px;">P '.$row['saleGross'].'</td>';
echo'</tr>';
  }
?>
</tbody>
<tfoot>
	<tr>
		<td></td>
		<td style="text-align:right;padding-right:20px;"><br />TOTAL : <?php echo $allTotal; ?></td>
	</tr>
</tfoot>
</table>


</body>
</html>

