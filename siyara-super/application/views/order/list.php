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
$.post('<?=base_url('admin/order/filterdata')?>',$('.filterdata').serialize(),function(){
	$('.data_container').load('<?=base_url('admin/order/list_data')?>');
});
}
//------------------------------------------------------------------
function load_records()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$('.data_container').load('<?=base_url('admin/order/list_data')?>');
}
load_records();

//---------------------------------------------------------------------
$("body").on("change",".tgl_checkbox",function(){
$.post('<?=base_url("admin/order/change_status")?>',
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


<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Available List of Orders</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/order/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New Order</a>
          <?php endif; ?>
        </div>
      </div>
    </div>

<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="50">Order ID</th>
                <th>Customer ID</th>
                <th>Total Amount</th>
                <th>Discount Percent</th>
                <th>Discount Amount</th>
                <th>Payable Amount</th>
                <th>Billing Address</th>
                <th>Delivery Address</th>
                <th>Date</th>
                <th width="100"><?= trans('status') ?></th>
                <th width="120"><?= trans('action') ?></th>
            </tr>
        </thead>

       
        <tbody>
            <?php foreach($info as $row): ?>
            <tr>
            	<td>
					<?=$row['order_id']?>
                </td>
                <td>
					<?=$row['customer_id']?>
                </td>
                <td>
                    <?=$row['total_amount']?>
                </td> 
                <td>
					<?=$row['discount_percent']?>
                </td>
                <td>
					<?=$row['discount_amount']?>
                </td>
                <td>
					<?=$row['payable_amount']?>
                </td>
                <td>
					<?=$row['billing_address']?>
                </td>
                <td>
					<?=$row['delivery_address']?>
                </td>
                <td>
					<?=$row['date']?>
                </td>
                <td><input class='tgl tgl-ios tgl_checkbox' 
                    data-id="<?=$row['order_id']?>" 
                    id='cb_<?=$row['order_id']?>' 
                    type='checkbox' <?php echo (1 == 1)? "checked" : ""; ?> />
                    <label class='tgl-btn' for='cb_<?=$row['order_id']?>'></label>
                </td>
                <td>
                    <a href="<?= base_url("admin/order/edit/".$row['order_id']); ?>" class="btn btn-warning btn-xs mr5" >
                    <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url("admin/order/delete/".$row['order_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

