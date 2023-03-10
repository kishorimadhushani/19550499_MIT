  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_customer') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('customer'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('customers_list') ?></a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('customer/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="customer_id" class="col-md-2 control-label"><?= trans('customer_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="customer_id" class="form-control" id="customer_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="customername" class="col-md-2 control-label"><?= trans('customername') ?></label>

                <div class="col-md-12">
                  <input type="text" name="customername" class="form-control" id="customername" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="email" class="col-md-2 control-label"><?= trans('email') ?></label>

                <div class="col-md-12">
                  <input type="email" name="email" class="form-control" id="email" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-2 control-label"><?= trans('password') ?></label>

                <div class="col-md-12">
                  <input type="password" name="password" class="form-control" id="password" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-md-2 control-label"><?= trans('address') ?></label>

                <div class="col-md-12">
                  <input type="address" name="address" class="form-control" id="address" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_number" class="col-md-2 control-label"><?= trans('mobile_number') ?></label>

                <div class="col-md-12">
                  <input type="mobile_number" name="mobile_number" class="form-control" id="mobile_number" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="<?= trans('add_customer') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>