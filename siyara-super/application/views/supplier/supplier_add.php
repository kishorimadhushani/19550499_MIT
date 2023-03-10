  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_supplier') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/supplier'); ?>" class="btn btn-success"><i class="fa fa-list"></i> suppliers List</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/supplier/add'), 'class="form-horizontal"');  ?> 
              <div class="form-group">
                <label for="supplier_id" class="col-md-2 control-label">Supplier Id</label>

                <div class="col-md-12">
                  <input type="number" name="supplier_id" class="form-control" id="supplier_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="supplier_name" class="col-md-2 control-label">Supplier Name</label>

                <div class="col-md-12">
                  <input type="text" name="supplier_name" class="form-control" id="supplier_name" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="e-mail" class="col-md-2 control-label">E-mail</label>

                <div class="col-md-12">
                  <input type="text" name="e-mail" class="form-control" id="e-mail" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-2 control-label">Password</label>

                <div class="col-md-12">
                  <input type="password" name="password" class="form-control" id="password" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="address" class="col-md-2 control-label">Address</label>

                <div class="col-md-12">
                  <input type="text" name="address" class="form-control" id="address" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="mobile_number" class="col-md-2 control-label">Mobile Number</label>

                <div class="col-md-12">
                  <input type="number" name="mobile_number" class="form-control" id="mobile_number" placeholder="">
                </div>
              </div>

              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Add Supplier" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>