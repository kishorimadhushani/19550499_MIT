  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_product') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/product'); ?>" class="btn btn-success"><i class="fa fa-list"></i> Products List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/product/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="product_id" class="col-md-2 control-label">Product Id</label>

                <div class="col-md-12">
                  <input type="number" name="product_id" class="form-control" id="product_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="product_name" class="col-md-2 control-label">Product Name</label>

                <div class="col-md-12">
                  <input type="text" name="product_name" class="form-control" id="product_name" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="brand_name" class="col-md-2 control-label">Brand</label>

                <div class="col-md-12">
                  <input type="text" name="brand_name" class="form-control" id="brand_name" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="price" class="col-md-2 control-label">Unit Price</label>

                <div class="col-md-12">
                  <input type="number" name="price" class="form-control" id="price" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="quantity" class="col-md-2 control-label">Quantity</label>

                <div class="col-md-12">
                  <input type="number" name="quantity" class="form-control" id="quantity" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="photo" class="col-md-2 control-label">Photo</label>

                <div class="col-md-12">
                  <input type="photo" name="photo" class="form-control" id="photo" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="description" class="col-md-2 control-label">Description</label>

                <div class="col-md-12">
                  <input type="text" name="description" class="form-control" id="description" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="<?= trans('add_product') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>