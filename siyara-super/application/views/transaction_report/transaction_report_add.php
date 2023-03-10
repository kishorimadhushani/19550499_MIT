  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_transaction_report') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('transaction_report'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('transaction_reports_list') ?></a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('includes/_messages.php') ?>

            <?php echo form_open(base_url('transaction_report/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="transaction_report_id" class="col-md-2 control-label"><?= trans('transaction_report_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="transaction_report_id" class="form-control" id="transaction_report_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="customer_id" class="col-md-2 control-label"><?= trans('customer_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="customer_id" class="form-control" id="customer_id" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="order_id" class="col-md-2 control-label"><?= trans('order_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="order_id" class="form-control" id="order_id" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="product_id" class="col-md-2 control-label"><?= trans('product_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="product_id" class="form-control" id="product_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="payment_id" class="col-md-2 control-label"><?= trans('payment_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="payment_id" class="form-control" id="payment_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="date" class="col-md-2 control-label"><?= trans('date') ?></label>

                <div class="col-md-12">
                  <input type="date" name="date" class="form-control" id="date" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="<?= trans('add_transaction_report') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>