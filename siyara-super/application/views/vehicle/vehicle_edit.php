  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; <?= trans('edit_vehicle') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/vehicle/index'); ?>" class="btn btn-success"><i class="fa fa-list"></i>vehicles List</a>
            <a href="<?= base_url('admin/vehicle/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i>Add New vehicle</a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>
           
            <?php echo form_open(base_url('admin/vehicle/edit/'.$vehicle['vehicle_id']), 'class="form-horizontal"' )?> 

            <div class="form-group">
                <label for="vehicle_id" class="col-md-2 control-label">vehicle ID</label>

                <div class="col-md-12">
                  <input type="text" name="vehicle_id" value="<?= $vehicle['vehicle_id']; ?>" class="form-control" id="vehicle_id" placeholder="">
                </div>
              </div>
 
              <div class="form-group">
                <label for="type" class="col-md-2 control-label">Type</label>

                <div class="col-md-12">
                  <input type="text" name="type" value="<?= $vehicle['type']; ?>" class="form-control" id="quantypetity" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="description" class="col-md-2 control-label">Description</label>

                <div class="col-md-12">
                  <input type="text" name="description" value="<?= $vehicle['description']; ?>" class="form-control" id="description" placeholder="">
                </div>
              </div>
             
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="Update Vehicle" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
          <!-- /.box-body -->
      </div>  
    </section> 
  </div>