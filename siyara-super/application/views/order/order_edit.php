  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; Edit Order </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('order'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Orders List</a>
            <a href="<?= base_url('order/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i>Add New Order</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
 
            <?php echo form_open(base_url('admin/order/edit/'.$order['order_id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="order_id" class="col-md-2 control-label">Order ID</label>

                <div class="col-md-12">
                  <input type="number" name="order_id" value="<?= $order['order_id']; ?>" class="form-control" id="order_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="customer_id" class="col-md-2 control-label">Customer ID</label>

                <div class="col-md-12">
                  <input type="number" name="customer_id" value="<?= $order['customer_id']; ?>" class="form-control" id="customer_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="total_amount" class="col-md-2 control-label">Total Amount</label>

                <div class="col-md-12">
                  <input type="number" name="total_amount" value="<?= $order['total_amount']; ?>" class="form-control" id="total_amount" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="discount_percent" class="col-md-2 control-label">Discount Percent</label>

                <div class="col-md-12">
                  <input type="text" name="discount_percent" value="<?= $order['discount_percent']; ?>" class="form-control" id="discount_percent" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="discount_amount" class="col-md-2 control-label">Discount Amount</label>

                <div class="col-md-12">
                  <input type="number" name="discount_amount" value="<?= $order['discount_amount']; ?>" class="form-control" id="discount_amount" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="payable_amount" class="col-md-2 control-label">Payable Amount</label>

                <div class="col-md-12">
                  <input type="number" name="payable_amount" value="<?= $order['payable_amount']; ?>" class="form-control" id="payable_amount" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="billing_address" class="col-md-2 control-label">Billing Address</label>

                <div class="col-md-12">
                  <input type="text" name="billing_address" value="<?= $order['billing_address']; ?>" class="form-control" id="billing_address" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="delivery_address" class="col-md-2 control-label">Delivery Address</label>

                <div class="col-md-12">
                  <input type="text" name="delivery_address" value="<?= $order['delivery_address']; ?>" class="form-control" id="delivery_address" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="col-md-2 control-label">Date</label>

                <div class="col-md-12">
                  <input type="date" name="date" value="<?= $order['date']; ?>" class="form-control" id="date" placeholder="">
                </div>
              </div>
             <!-- <div class="form-group">
                <label for="role" class="col-md-2 control-label">status</label>

                <div class="col-md-12">
                  <select name="status" class="form-control">
                    <option value="">select_status</option>
                    <option value="1" <?= ($order['is_active'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($order['is_active'] == 0)?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>-->
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update Order" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
          <!-- /.box-body -->
      </div>  
    </section> 
  </div>