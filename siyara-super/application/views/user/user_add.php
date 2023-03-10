  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-plus"></i>
             <?= trans('add_new_user') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-success"><i class="fa fa-list"></i>  <?= trans('users_list') ?></a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('admin/includes/_messages.php') ?>

            <?php echo form_open(base_url('admin/users/add'), 'class="form-horizontal"');  ?> 
            <div class="form-group">
                <label for="user_id" class="col-md-2 control-label"><?= trans('user_id') ?></label>

                <div class="col-md-12">
                  <input type="number" name="user_id" class="form-control" id="user_id" placeholder="">
                </div>
              </div>
            
            <div class="form-group">
                <label for="user_name" class="col-md-2 control-label"><?= trans('user_name') ?></label>

                <div class="col-md-12">
                  <input type="text" name="user_name" class="form-control" id="user_name" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="password" class="col-md-2 control-label"><?= trans('password') ?></label>

                <div class="col-md-12">
                  <input type="password" name="password" class="form-control" id="password" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-2 control-label"><?= trans('email') ?></label>

                <div class="col-md-12">
                  <input type="email" name="email" class="form-control" id="email" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <label for="address" class="col-md-2 control-label"><?= trans('address') ?></label>

                <div class="col-md-12">
                  <input type="text" name="address" class="form-control" id="address" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="mobile_no" class="col-md-2 control-label"><?= trans('mobile_no') ?></label>

                <div class="col-md-12">
                  <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="<?= trans('add_user') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close( ); ?>
        </div>
          <!-- /.box-body -->
      </div>
    </section> 
  </div>