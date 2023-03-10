  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_payment') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('payment'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('payments_list') ?></a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('includes/_messages.php') ?>

            <?php echo form_open(base_url('payments/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="payment_id" class="col-md-2 control-label"><?= trans('payment_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="payment_id" class="form-control" id="payment_id" placeholder="">
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
                <label for="total_amount" class="col-md-2 control-label"><?= trans('total_amount') ?></label>

                <div class="col-md-12">
                  <input type="number" name="total_amount" class="form-control" id="total_amount" placeholder="">
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
                  <input type="submit" name="submit" value="<?= trans('add_payment') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>