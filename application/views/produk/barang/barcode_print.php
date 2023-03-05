<!DOCTYPE html>
<html>
<head>
	<title>Barcode <?=ucfirst($row->nama)?></title>
</head>
<body>
	<table>

    <?php
      	$br = $row->barcode;
        for($i= 0;$i<9;$i++){ 
    ?>
    	<tr>
    	<?php for($j= 0;$j<6;$j++){ ?>
      		<td>
			<?php
			$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
			echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128, 3, 100)) . '"style="width:105px"><br>'.$br.'<br><br>';
			?>
			</td>
		    <td style="width: 60px">
    <?php
            }
	    }
    ?>
		    </td>
		</tr>
  </table>
</body>
</html>
