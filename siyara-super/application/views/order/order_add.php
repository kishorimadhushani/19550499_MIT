  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_order') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/order'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Orders List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/order/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="order_id" class="col-md-2 control-label">Order Id</label>

                <div class="col-md-12">
                  <input type="number" name="order_id" class="form-control" id="order_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="customer_id" class="col-md-2 control-label">Customer Id</label>

                <div class="col-md-12">
                  <input type="number" name="customer_id" class="form-control" id="customer_id" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="total_amount" class="col-md-2 control-label">Total Amount</label>

                <div class="col-md-12">
                  <input type="number" name="total_amount" class="form-control" id="total_amount" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="discount_percent" class="col-md-2 control-label">Discount Percentage</label>

                <div class="col-md-12">
                  <input type="text" name="discount_percent" class="form-control" id="discount_percent" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="discount_amount" class="col-md-2 control-label">Discount_amount</label>

                <div class="col-md-12">
                  <input type="number" name="discount_amount" class="form-control" id="discount_amount" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="payable_amount" class="col-md-2 control-label">Payable Amount</label>

                <div class="col-md-12">
                  <input type="number" name="payable_amount" class="form-control" id="payable_amount" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="billing_address" class="col-md-2 control-label">Billing Address</label>

                <div class="col-md-12">
                  <input type="text" name="billing_address" class="form-control" id="billing_address" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="delivery_address" class="col-md-2 control-label">Delivery Address</label>

                <div class="col-md-12">
                  <input type="text" name="delivery_address" class="form-control" id="delivery_address" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="date" class="col-md-2 control-label">Date</label>

                <div class="col-md-12">
                  <input type="date" name="date" class="form-control" id="date" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add Order" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>