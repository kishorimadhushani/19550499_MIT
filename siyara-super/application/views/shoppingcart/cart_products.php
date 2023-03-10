
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
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Available List of Products</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/shoppingcart/cart'); ?>" class="btn btn-warning"> View Shopping Cart </a>
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
                <th width="100">No of Items to Buy</th>
                <th width="120"><?= trans('action') ?></th>
            </tr>
        </thead>

       
        <tbody>
            <?php foreach($info as $row): ?>
            <tr>
              <form action="<?= base_url('admin/shoppingcart/add_to_cart/'.$row['product_id'])?>">
                  <td>
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
                        Rs.<?=number_format($row['price'], 2, '.', '')?>
                        <input type="hidden" id="price" name="price" value="<?=$row['price']?>">
                  </td> 
                  <td style="text-align:right">
                        <?=$row['quantity']?>
                        <input type="hidden" id="available_quantity" name="available_quantity" value="<?=$row['quantity']?>">
                  </td>
                  <td >
                        <img src="<?=$row['photo']?>" width="100" height="100" class="img-circle">
                        <input type="hidden" id="photo" name="photo" value="<?=$row['photo']?>">
                  </td> 
                  <td style="text-align:right">
                        <input style="text-align:right" type="number" name="quantity<?=$row['product_id']?>" id="quantity<?=$row['product_id']?>" value="0" min="0" max="<?=$row['quantity']?>" required="">
                  </td>
                  <td>  
                    <input type="image" src="<?=base_url('assets/dist/img')?>/cart-button.png" alt="Submit" width="100" height="30">
                  
                  </td>
              </form>
            </tr>
            <?php endforeach;?>
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






