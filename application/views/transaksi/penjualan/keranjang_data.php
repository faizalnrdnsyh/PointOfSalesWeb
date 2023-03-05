<?php $no = 1;
if($keranjang->num_rows() > 0){
  foreach ($keranjang->result() as $k => $data) { ?>
    <tr>
      <td><?=$no++?></td>
      <td class="barcode"><?=$data->barcode?></td>
      <td class="text-left"><?=$data->nama_barang?></td>
      <td class="text-right"><?=$data->harga_k?></td>
      <td><?=$data->qty?></td>
      <td class="text-right"><?=$data->diskon?></td>
      <td class="text-right" id="total"><?=$data->total?></td>
      <td>
        <button id="ubah_keranjang" data-toggle="modal" data-target="#modal-ubah-barang"
        data-id="<?=$data->id_keranjang?>"
        data-barcode="<?=$data->barcode?>"
        data-barang="<?=$data->nama_barang?>"
        data-harga="<?=$data->harga_k?>"
        data-qty="<?=$data->qty?>"
        data-stok="<?=$data->stok?>"
        data-diskon_barang="<?=$data->diskon_barang?>"
        data-total="<?=$data->total?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil-alt"></i> Ubah</button>
        <button id="hapus_keranjang"  data-id="<?=$data->id_keranjang?>" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i> Hapus</button>
      </td>
    </tr>
<?php } 
} else { 
	echo '<tr>
			<td colspan="8" class="text-center"> Tidak ada barang </td>
		</tr>';
} ?>