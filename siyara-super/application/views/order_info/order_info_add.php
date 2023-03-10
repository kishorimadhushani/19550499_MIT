  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_order_info') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('order_info'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('order_infos_list') ?></a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('includes/_messages.php') ?>

            <?php echo form_open(base_url('order_infos/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="order_info_id" class="col-md-2 control-label"><?= trans('order_info_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="order_info_id" class="form-control" id="order_info_id" placeholder="">
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
                <label for="product_price" class="col-md-2 control-label"><?= trans('product_price') ?></label>

                <div class="col-md-12">
                  <input type="number" name="product_price" class="form-control" id="product_price" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="quantity" class="col-md-2 control-label"><?= trans('quantity') ?></label>

                <div class="col-md-12">
                  <input type="number" name="quantity" class="form-control" id="quantity" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="<?= trans('add_order_info') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>