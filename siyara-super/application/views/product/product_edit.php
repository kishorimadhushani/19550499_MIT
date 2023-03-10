  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; <?= trans('edit_product') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/product/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i>Products List</a>
            <a href="<?= base_url('admin/product/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i>Add New Product</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/product/edit/'.$product['product_id']), 'class="form-horizontal"' )?> 

            <div class="form-group">
                <label for="product_id" class="col-md-2 control-label">Product ID</label>

                <div class="col-md-12">
                  <input type="number" name="product_id" value="<?= $product['product_id']; ?>" class="form-control" id="quantity" placeholder="">
                </div>
              </div>
 
              <div class="form-group">
                <label for="product_name" class="col-md-2 control-label">Quantity</label>

                <div class="col-md-12">
                  <input type="text" name="product_name" value="<?= $product['product_name']; ?>" class="form-control" id="quantity" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="brand_name" class="col-md-2 control-label">Brand Name</label>

                <div class="col-md-12">
                  <input type="text" name="brand_name" value="<?= $product['brand_name']; ?>" class="form-control" id="quantity" placeholder="">
                </div>
              </div>

            <div class="form-group">
                <label for="quantity" class="col-md-2 control-label">Quantity</label>

                <div class="col-md-12">
                  <input type="number" name="quantity" value="<?= $product['quantity']; ?>" class="form-control" id="quantity" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="price" class="col-md-2 control-label">Price</label>

                <div class="col-md-12">
                  <input type="number" name="price" value="<?= $product['price']; ?>" class="form-control" id="quantity" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="photo" class="col-md-2 control-label">Photo</label>

                <div class="col-md-12">
                  <input type="text" name="photo" value="<?= $product['photo']; ?>" class="form-control" id="photo" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="description" class="col-md-2 control-label">Description</label>

                <div class="col-md-12">
                  <input type="text" name="description" value="<?= $product['description']; ?>" class="form-control" id="description" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="role" class="col-md-2 control-label">Status</label>

               <div class="col-md-12">
                 <select name="status" class="form-control">
                    <option value=""><?= trans('select_status') ?></option>
                    <option value="1" <?= ($product['is_active'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($product['is_active'] == 0)?'selected': '' ?>>Deactive</option>
                 </select>
                </div>
              </div> 
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="<?= trans('update_product') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
          <!-- /.box-body -->
      </div>  
    </section> 
  </div>