  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; <?= trans('edit_driver') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/driver/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i>drivers List</a>
            <a href="<?= base_url('admin/driver/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i>Add New driver</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/driver/edit/'.$driver['driver_id']), 'class="form-horizontal"' )?> 

            <div class="form-group">
                <label for="driver_id" class="col-md-2 control-label">driver ID</label>

                <div class="col-md-12">
                  <input type="number" name="driver_id" value="<?= $driver['driver_id']; ?>" class="form-control" id="quantity" placeholder="">
                </div>
              </div>
 
              <div class="form-group">
                <label for="driver_name" class="col-md-2 control-label">driver Name</label>

                <div class="col-md-12">
                  <input type="text" name="driver_name" value="<?= $driver['driver_name']; ?>" class="form-control" id="quantity" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="e-mail" class="col-md-2 control-label">E-mail</label>

                <div class="col-md-12">
                  <input type="text" name="e-mail" value="<?= $driver['e-mail']; ?>" class="form-control" id="e-mail" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-2 control-label">Password</label>

                <div class="col-md-12">
                  <input type="password" name="password" value="<?= $driver['password']; ?>" class="form-control" id="password" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="address" class="col-md-2 control-label">Address</label>

                <div class="col-md-12">
                  <input type="text" name="address" value="<?= $driver['address']; ?>" class="form-control" id="address" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="mobile_number" class="col-md-2 control-label">Mobile Number</label>

                <div class="col-md-12">
                  <input type="number" name="mobile_number" value="<?= $driver['mobile_number']; ?>" class="form-control" id="mobile_number" placeholder="">
                </div>
              </div>

              </div>
              <div class="form-group">
                <label for="role" class="col-md-2 control-label">Status</label>

               <div class="col-md-12">
                 <select name="status" class="form-control">
                    <option value=""><?= trans('select_status') ?></option>
                    <option value="1" <?= ($driver['is_active'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($driver['is_active'] == 0)?'selected': '' ?>>Deactive</option>
                 </select>
                </div>
              </div> 
              <div class="form-group">
                <div class="col-md-12">
                <input type="submit" name="submit" value="Update Driver" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
          <!-- /.box-body -->
      </div>  
    </section> 
  </div>