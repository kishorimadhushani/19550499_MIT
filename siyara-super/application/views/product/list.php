
<!-- DataTables -->
<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });

</script> 

<script>
//------------------------------------------------------------------
function filter_data()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$.post('<?=base_url('admin/vehicle/filterdata')?>',$('.filterdata').serialize(),function(){
	$('.data_container').load('<?=base_url('admin/vehicle/list_data')?>');
});
}
//------------------------------------------------------------------
function load_records()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$('.data_container').load('<?=base_url('admin/vehicle/list_data')?>');
}
load_records();

//---------------------------------------------------------------------
$("body").on("change",".tgl_checkbox",function(){
$.post('<?=base_url("admin/vehicle/change_status")?>',
{
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
	id : $(this).data('id'),
	status : $(this).is(':checked')==true?1:0
},
function(data){
	$.notify("Status Changed Successfully", "success");
});
});
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Available List of Products</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/product/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Product</a>
            <a href="<?= base_url('admin/product/add'); ?>" class="btn btn-primary"><i class="fa fa-download"></i></a>
            <a href="<?= base_url('admin/product/add'); ?>" class="btn btn-primary"><i class="fa fa-print"></i></a>
          <?php endif; ?>
        </div>
      </div>
    </div>

<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="50">Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Photo</th>
                <th width="100"><?= trans('status') ?></th>
                <th width="120"><?= trans('action') ?></th>
            </tr>
        </thead>

       
        <tbody>
            <?php foreach($info as $row): ?>
            <tr>
            	<td>
					<?=$row['product_id']?>
                </td>
                <td>
					<h4 class="m0 mb5"><?=$row['brand_name']?> <?=$row['product_name']?> </h4>
                    <small class="text-muted"><?=$row['description']?></small>
                </td>
                <td>
                    <?=$row['price']?>
                </td> 
                <td>
					<?=$row['quantity']?>
                </td>
                <td>
                     <img src="<?=$row['photo']?>" width="80" height="80" >
                </td> 
                <td><input class='tgl tgl-ios tgl_checkbox' 
                    data-id="<?=$row['product_id']?>" 
                    id='cb_<?=$row['product_id']?>' 
                    type='checkbox' <?php echo (1 == 1)? "checked" : ""; ?> />
                    <label class='tgl-btn' for='cb_<?=$row['product_id']?>'></label>
                </td>
                <td>
                    <a href="<?= base_url("admin/product/edit/".$row['product_id']); ?>" class="btn btn-warning btn-xs mr5" >
                    <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url("admin/product/delete/".$row['product_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

