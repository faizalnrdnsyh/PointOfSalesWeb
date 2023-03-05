<?php if ($this->session->has_userdata('sukses')){?>
<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="icon fas fa-check"></i><?=$this->session->flashdata('sukses');?>
</div>
<?php } ?>

<?php if ($this->session->has_userdata('peringatan')){?>
<div class="alert alert-warning alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<i class="icon fas fa-exclamation-triangle"></i><?=$this->session->flashdata('peringatan');?>
</div>
<?php } ?>