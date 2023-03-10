<!-- bootstrap datepicker -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datepicker/datepicker3.css">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
              &nbsp;Prepare Invoice </h3>
          </div>
          <div class="d-inline-block float-right">
             <a href="<?= base_url('admin/invoices'); ?>" class="btn btn-success"><i class="fa fa-list"></i> <?= trans('invoice_list') ?></a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open( base_url('admin/invoices/add')); ?>
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header with-border">
                    <h3 class="card-title"><?= trans('bill_from') ?></h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">

                      <div class="form-group">
                        <label for="company_name" class="control-label"><?= trans('company_name') ?></label>
                        <input readonly type="text" name="company_name" class="form-control" id="company_name" value="Siyara Super City" placeholder="" required>
                      </div>
                      <div class="form-group">
                        <label for="address1" class="control-label"><?= trans('address_line') ?>1</label>
                        <input readonly type="text" name="company_address_1" class="form-control" id="address1" value="No 433, Colombo Rd," placeholder="" required>
                      </div>

                      <div class="form-group">
                        <label for="address2" class="control-label"><?= trans('address_line') ?>2</label>
                        <input readonly type="address2" name="company_address_2" class="form-control" id="address2" value="Palm Garden,  Ratnapura" >
                      </div>
                      <div class="form-group">
                        <label for="email" class="control-label"><?= trans('email') ?></label>
                        <input readonly type="email" name="company_email" class="form-control" id="" value="sales@siyarasuper.com" placeholder="" required>
                      </div>
                      <div class="form-group">
                        <label for="mobile_no" class="control-label"><?= trans('mobile_no') ?></label>
                        <input readonly type="number" name="company_mobile_no" class="form-control" id="" value="0452228937" placeholder="" required>
                      </div>

                    </div>
                    <!-- /.card-body -->
                </div>
              </div>
              <?php $total=0; ?>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header with-border">
                    <h3 class="card-title">Delivery Information</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <div class="card-body">
                      
                      <div class="form-group">
                        <label for="firstname" class="control-label"><?= trans('firstname') ?></label>
                        <input type="text" name="firstname" class="form-control" id="firstname" placeholder="" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="address" class="control-label"><?= trans('address') ?></label>
                        <input type="text" name="client_address" class="form-control" id="address" placeholder="" required>
                      </div>

                      <div class="form-group">
                        <label for="email" class="control-label"><?= trans('email') ?></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="" required>
                      </div>
                      <div class="form-group">
                        <label for="mobile_no" class="control-label"><?= trans('mobile_no') ?></label>
                        <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="" required>
                      </div>

                    </div>
                    <!-- /.card-body -->
                </div>
              </div>

              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="invoice_no" class="control-label"><?= trans('invoice') ?>#</label>
                          <input readonly type="text" name="invoice_no" class="form-control" id="invoice_no" value="Inv-1001-<?=$this->session->userdata('admin_id');?>" required>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="date" class="control-label"><?= trans('billing_date') ?></label>
                        <input readonly type="date" name="billing_date" class="form-control" id="billing_date" value="<?=date("Y-m-d");?>" >
                      </div>
                      <div class="col-md-3">
                        <label for="date" class="control-label">Delivery Date</label>
                          <input readonly type="text" name="delivery_date" class="form-control" id="delivery_date" value="<?=date('Y-m-d', strtotime('next sunday'));?>" required>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="firstname" class="control-label" required><?= trans('status') ?></label>
                          <input readonly type="text" name="payment" class="form-control" id="due_date" value="Pay at Delivery" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th><?= trans('action') ?></th>
                          <th width="40%"><?= trans('product') ?></th>
                          <th>Unit Price</th>
                          <th>Quantity</th>
                          <th><?= trans('total') ?></th>
                        </tr>
                      </thead>
                      <tbody class="field_wrapper">
                        <?php foreach($info as $row): ?>
                          <tr class="item">
                            <td>
                              <?=$row['product_id']?>
                            </td>
                            <td>
                              <div class="form-group">
                              <h4 class="m0 mb5"><?=$row['brand_name']?> <?=$row['product_name']?> </h4>
                              <small class="text-muted"><?=$row['description']?></small>
                              <input type="hidden" id="brand_name" name="brand_name" value="<?=$row['brand_name']?>">
                              <input type="hidden" id="product_name" name="product_name" value="<?=$row['product_name']?>"> 
                              <input type="hidden" id="description" name="description" value="<?=$row['description']?>"> 
                              </div>
                            </td>
                            <td>
                            <div class="form-group">
                                Rs.<?=number_format($row['product_price'], 2, '.', '')?>
                                <input type="hidden" id="price" name="price" value="<?=$row['product_price']?>">
                                </div>
                            </td>
                            <td>
                              <div class="form-group">
                              <?=$row['quantity']?>
                             <input type="hidden" id="old_quantity" name="old_quantity" value="<?=$row['quantity']?>">
                              </div>
                            </td>
                            <td>
                              Rs.<?=number_format($row['sub_total'], 2, '.', '');?>
                              <input type="hidden" id="sub_total" name="sub_total" value="<?=$row['sub_total']?>">
                           </td>

                          </tr>
                          <?php $total=$total+$row['sub_total']; ?>
                        <?php endforeach;?>
                      </tbody>
                    </table>

                    <div class="col-md-5 pull-right">
                      <table class="table">
                        <tr>
                          <th><strong><?= trans('subtotal') ?>: </strong></th>
                          <input type="hidden" name="sub_total" class="sub_total">
                          <td class="text-right"><span class="sub_total">Rs.<b><?= number_format($total, 2, '.', '')?></b></span></td>
                        </tr>
                        <tr>
                          <th><strong>Tax (15% VAT): </strong></th>
                          <input type="hidden" name="total_tax" class="total_tax">
                          <td class="text-right"><span class="total_tax">Rs.<b><?= number_format(($total*.15), 2, '.', '')?></b></span></td>
                        </tr>
                        
                        <tr>
                          <input type="hidden" name="grand_total" class="grand_total" value="">
                          <th><strong><?= trans('total') ?>: </strong></th>
                          <td class="text-right"><span id="grand_total">Rs.<b><?= number_format(($total+($total*.15)), 2, '.', '')?></b></span></td>
                        </tr>
                      </table>
                    </div>  


                  </div>
                    <!-- /.card-body -->
                </div>
              </div>

              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                     <div class="form-group">
                        <label for="invoice_no" class="control-label"><?= trans('client_note') ?></label>
                        <textarea name="client_note" class="form-control" rows="2" placeholder="Do not deliver on saturdays" ></textarea>
                      </div>
                      <div class="form-group">
                        <label for="invoice_no" class="control-label"><?= trans('terms_and_conditions') ?></label>
                        <textarea readonly name="termsncondition" class="form-control" rows="3" placeholder="" >No exchange of products after 7 days of purchase. Customer should present this receipt in a case of product exchange or warrenty claim.</textarea>
                      </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="card">
                  <div class="card-body">
                    <input type="submit" name="submit" value="Save Invoice" class="btn btn-primary pull-right">
                  </div>
                </div>
              </div>
            </div>
          <?php echo form_close(); ?>
        </div>  
      </div>
    </section> 



 <!-- bootstrap datepicker -->
  <script src="<?= base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
  <script>
    $('.datepicker').datepicker({
      autoclose: true
    });
  </script>

  <script type="text/javascript">
    $(function(){

      //---------------------------------------------------------------
      $('#customer').change(function(e){
        var id = $('#customer').val();
        var post_data = {
          '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
        };
        $.ajax({
          type: 'POST',
          url: '<?= base_url("admin/invoices/customer_detail/"); ?>'+id,
          data: post_data,
          success: function(response){
            var data = JSON.parse(response);
            console.log(data.id);
            $('#firstname').val(data.firstname);
            $('#address').val(data.address);
            $('#email').val(data.email);
            $('#mobile_no').val(data.mobile_no);
          }
        });

      });

      //---------------------------------------------------------------
      $(document).on("click change paste keyup", ".calcEvent", function() {
        calculate_total();
      });

      var max_field = 10;
      var add_button = $('.add_button');
      var wrapper = $('.field_wrapper');
      var html_fields = '<tr class="item"><td> <a href="javascript:void(0);" class="remove_button btn btn-sm btn-danger" title="Remove field"><i class="fa fa-minus"></i></a> </td> <td> <div class="form-group"> <input type="text" name="product_description[]" class="form-control calcEvent" id="product_description" placeholder="Description" required> </div> </td> <td> <div class="form-group"> <input type="text" name="quantity[]" value="1" class="form-control calcEvent quantity" id="quantity" placeholder="" required> </div> </td> <td> <div class="form-group"> <input type="text" name="price[]" class="form-control calcEvent price" id="price" placeholder="" required> </div> </td> <td> <div class="form-group"> <input type="text" name="tax[]" class="form-control calcEvent tax" id="tax" placeholder="" required> </div> </td> <td> <input type="hidden" name="total[]" class="form-control calcEvent item_total" placeholder="" required><strong class="item_total">0.00</strong> </td> </tr>';

      var x = 1; // 

      $(add_button).click(function(){
        if(x < max_field){
          x++;
          $(wrapper).append(html_fields);
        }

      });

      $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).closest('tr').remove(); //Remove field html
        x--; //Decrement field counter
      });

    });


     //---------------------------------------------------------------
     function calculate_total(){

        var sub_total    = 0;
        var total       = 0;
        var amountDue   = 0;
        var total_tax    = 0;

        $('tr.item').each(function(){
          var quantity = parseFloat($(this).find(".quantity").val());
          var price = parseFloat($(this).find(".price").val());
          var item_tax = $(this).find(".tax").val();

          var item_total = parseFloat(quantity * price) > 0 ? parseFloat(quantity * price) : 0 ;
          sub_total += parseFloat(price * quantity) > 0 ? parseFloat(price * quantity) : 0;
          total_tax += parseFloat(price * quantity * item_tax/100) > 0 ? parseFloat(price * quantity * item_tax/100) : 0;

          $(this).find('.item_total').text( item_total.toFixed(2) );
          $(this).find('.item_total').val( item_total.toFixed(2) ); 
        });

        var discount    = parseFloat($("[name='discount']").val()) > 0 ? parseFloat($("[name='discount']").val()) : 0;
        total += parseFloat(sub_total + total_tax - discount);

        $( '.sub_total' ).text( sub_total.toFixed(2) );
        $( '.sub_total' ).val( sub_total.toFixed(2) ); // for hidden field

        $( '.total_tax' ).text( total_tax.toFixed(2) );
        $( '.total_tax' ).val( total_tax.toFixed(2) ); // for hidden field

        $( '#grand_total' ).text( total.toFixed(2) );
        $( '.grand_total' ).val( total.toFixed(2) ); // for hidden field

     }


  </script>

  <script>
    $('#invoices').addClass('active');
  </script>