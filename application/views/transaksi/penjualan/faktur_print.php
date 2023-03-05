<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
	<head>
		<title>POS - Cetak Nota</title>
		<style type="text/css">
			html {font-family: 'system-ui';}
			.content {
				width: 58mm;
				font-size: 12px;
				padding: 5px;
				margin-left: 10px;
			}
			.title {
				text-align: center;
				font-size: 14px;
				padding-bottom: 5px;
				border-bottom: 1px dashed;
			}
			.head {
				margin-top: 3px;
				margin-bottom: 10px;
				padding-bottom: 10px;
				border-bottom: 1px solid;
			}
			.table {
				width: 100%;
				font-size: 12px;
			}
			.thanks {
				margin-top: 10px;
				padding-top: 10px;
				text-align: center;
				border-top: 1px dashed;
			}
			@media print {
				@page {
					width: 58mm;
					margin: 0mm;
				}
			}
		</style>
		<link rel="shortcut icon" href="<?=base_url()?>assets/dist/img/UnikLogo-title.png">
	</head>

	<body onload="window.print()">
		<div class="content">
			<div class="title">
				<b>Toko Unik</b>
				<br>
				Jl. Joyowinoto, Srihardono,
				<br>Pundong, Bantul
				<br>
				Telp. 087881737245
			</div>
			<div class="head">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>Tgl</td>
						<td style="text-align: center">:</td>
						<td>
							<?php 
							echo Date("d/m/Y", strtotime($penjualan->tanggal))." ". Date("H:i", strtotime($penjualan->penjualan_dibuat));
							?>
						</td>
					</tr>
					<tr>
						<td>No</td>
						<td style="text-align: center">:</td>
						<td>
							<?=$penjualan->invoice?>
						</td>
					<tr>
						<td>Kasir</td>
						<td style="text-align: center; width: 10px">:</td>
						<td style="text-align: left">
							 <?=ucfirst($penjualan->namapengguna)?>
						</td>
					</tr>	
					<tr>			
						<td>Pelanggan</td>
						<td style="text-align: center">:</td>
						<td style="text-align: left">
							<?=$penjualan->id_pelanggan == null ? "Umum" : $penjualan->nama_pelanggan?>
						</td>
					</tr>
				</table>
			</div>

			<div class="transaction">
				<table class="transaction-table" cellspacing="0" cellpadding="0">
					<?php
					$arr_diskon = array();
					foreach ($penjualan_detail as $key => $value) { ?>
					<tr>
						<td colspan="3"><?=$value->nama?></td>
					</tr>
					<tr>
						<td style="text-align: center; width: 60px"><?=$value->qty?></td>
						<td style="text-align: center; width: 20px">x</td>
						<td style="text-align: right; width: 80px"><?=$value->harga?></td>
						<td style="text-align: right; width: 80px"><?=$value->total?></td>
					</tr>
					<tr>
						<?php
						if ($value->diskon > 0) {
						 ?>
						<td colspan="3" style="text-align: right; width: 60px">-<?=$value->diskon?></td>
						<?php } ?>
					</tr>

					<?php } ?>

					<tr>
						<td colspan="4" style="border-bottom: 1px dashed; padding-top: 5px"></td>
					</tr>
					<?php if($penjualan->diskon > 0) { ?>
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right; padding-top: 5px">Subtotal </td>
						<td colspan="2"  style="text-align: right; padding-top: 5px"><?=format_uang($penjualan->total_harga)?>
						</td>
					</tr>
					<?php } ?>
					<?php if($penjualan->diskon > 0) { ?>
						<tr>
							<td></td>
							<td colspan="2" style="border-bottom: 1px dashed; text-align: right; padding-bottom: 5px">Diskon </td>
							<td colspan="2" style="border-bottom: 1px dashed; text-align: right; padding-bottom: 5px"><?=format_uang($penjualan->diskon)?>
							</td>
						</tr>
					<?php } ?>

					<tr>
						<td></td>
						<td colspan="2" style="text-align: right; padding-top: 5px">Total </td>
						<td colspan="2" style="text-align: right; padding-top: 5px; font-size: 13px">
							<b><?=format_uang($penjualan->total_akhir)?></b></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="2" style="text-align: right; padding-bottom: 5px">Bayar </td>
						<td colspan="2"  style="text-align: right; padding-bottom: 5px">
							<?=format_uang($penjualan->bayar)?></td>
					</tr>
					<tr>
						<td></td>
						<td colspan="2" style="border-top: 1px dashed; text-align: right; padding-top: 5px">Kembali</td>
						<td colspan="2" style="border-top: 1px dashed; text-align: right; padding-top: 5px"><?=format_uang($penjualan->kembali)?></td>
					</tr>
				</table>
			</div>
			<div class="thanks">
				=== Terima Kasih ===
			</div>
		</div>
		
	</body>
</html>