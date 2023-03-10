
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
$.post('<?=base_url('admin/shoppingcart/filterdata')?>',$('.filterdata').serialize(),function(){
	$('.data_container').load('<?=base_url('admin/shoppingcart/list_data')?>');
});
}
//------------------------------------------------------------------
function load_records()
{
$('.data_container').html('<div class="text-center"><img src="<?=base_url('assets/dist/img')?>/loading.png"/></div>');
$('.data_container').load('<?=base_url('admin/shoppingcart/list_data')?>');
}
load_records();

//---------------------------------------------------------------------
$("body").on("change",".tgl_checkbox",function(){
$.post('<?=base_url("admin/shoppingcart/change_status")?>',
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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Shopping Cart</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/shoppingcart/prepare_invoice'); ?>" class="btn btn-warning"> Checkout </a>
          <?php endif; ?>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/shoppingcart/cart_products'); ?>" class="btn btn-success"> More Shopping</a> &nbsp; &nbsp;
          <?php endif; ?>
        </div>
        
      </div>
    </div>


<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Sub Total</th>
                <th><?= trans('action') ?></th>
            </tr>
        </thead>

       
        <tbody>
            <?php $total=0; ?>
            <?php foreach($info as $row): ?>
            <tr>
              <form action="<?= base_url('admin/shoppingcart/add_to_cart/'.$row['product_id'])?>">
                  <td style="text-align:center">
                        <img src="<?=$row['photo']?>" width="60" height="60" class="img-circle" >
                        <input type="hidden" id="photo" name="photo" value="<?=$row['photo']?>">
                  </td>     
                  <td style="text-align:center">
                      <?=$row['product_id']?>
                  </td>
                  <td>
                      <h4 class="m0 mb5"><?=$row['brand_name']?> <?=$row['product_name']?> </h4>
                        <small class="text-muted"><?=$row['description']?></small>
                        <input type="hidden" id="brand_name" name="brand_name" value="<?=$row['brand_name']?>">
                        <input type="hidden" id="product_name" name="product_name" value="<?=$row['product_name']?>"> 
                        <input type="hidden" id="description" name="description" value="<?=$row['description']?>"> 
                  </td>
                  <td style="text-align:right">
                        Rs.<?=number_format($row['product_price'], 2, '.', '')?>
                        <input type="hidden" id="price" name="price" value="<?=$row['product_price']?>">
                        
                  </td> 
                  <td style="text-align:center">
                        <?=$row['quantity']?>
                        <input type="hidden" id="old_quantity" name="old_quantity" value="<?=$row['quantity']?>">
                  </td>
                  <td style="text-align:right">
                        Rs.<?=number_format($row['sub_total'], 2, '.', '');?>
                        <input type="hidden" id="sub_total" name="sub_total" value="<?=$row['sub_total']?>">
                  </td>
                  <td>  
                        <a href="<?= base_url("admin/shoppingcart/delete_order_info/".$row['order_info_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>  
                  </td>

              </form>
            </tr>
            <?php $total=$total+$row['sub_total']; ?>
            <?php endforeach;?>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>
                  <b>Total:</b>
              </td>
              <td style="text-align:right">
                Rs.<b><?= number_format($total, 2, '.', '')?></b>
              </td>
            </tr>
          </tbody>
    </table>
</div>

<script>
      // Get the img object using its Id
      img = document.getElementById("img1");
      // Function to increase image size
      function enlargeImg() {
        // Set image size to 1.5 times original
        img.style.transform = "scale(1.5)";
        // Animation effect
        img.style.transition = "transform 0.25s ease";
      }
      // Function to reset image size
      function resetImg() {
        // Set image size to original
        img.style.transform = "scale(1)";
        img.style.transition = "transform 0.25s ease";
      }
    </script>

<script>
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax": "<?=base_url('product/datatable_json')?>",
    "order": [[4,'desc']],
    "columnDefs": [
    { "targets": 0, "name": "id", 'searchable':true, 'orderable':true},
    { "targets": 1, "name": "username", 'searchable':true, 'orderable':true},
    { "targets": 2, "name": "email", 'searchable':true, 'orderable':true},
    { "targets": 3, "name": "mobile_no", 'searchable':true, 'orderable':true},
    { "targets": 4, "name": "created_at", 'searchable':false, 'orderable':false},
    { "targets": 5, "name": "is_active", 'searchable':true, 'orderable':true},
    { "targets": 6, "name": "is_verify", 'searchable':true, 'orderable':true},
    { "targets": 7, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
    ]
  });
</script>






