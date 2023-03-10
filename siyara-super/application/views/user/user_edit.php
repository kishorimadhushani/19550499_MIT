  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="card card-default">
        <div class="card-header">
          <div class="d-inline-block">
              <h3 class="card-title"> <i class="fa fa-pencil"></i>
              &nbsp; <?= trans('edit_user') ?> </h3>
          </div>
          <div class="d-inline-block float-right">
            <a href="<?= base_url('user'); ?>" class="btn btn-success"><i class="fa fa-list"></i> <?= trans('users_list') ?></a>
            <a href="<?= base_url('user/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> <?= trans('add_new_user') ?></a>
          </div>
        </div>
        <div class="card-body">
   
           <!-- For Messages -->
            <?php $this->load->view('includes/_messages.php') ?>
           
            <?php echo form_open(base_url('user/edit/'.$user['id']), 'class="form-horizontal"' )?> 
              <div class="form-group">
                <label for="user_id" class="col-md-2 control-label"><?= trans('user_id') ?></label>

                <div class="col-md-12">
                  <input type="text" name="user_id" value="<?= $user['user_id']; ?>" class="form-control" id="user_id" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="user_name" class="col-md-2 control-label"><?= trans('user_name') ?></label>

                <div class="col-md-12">
                  <input type="text" name="user_name" value="<?= $user['user_name']; ?>" class="form-control" id="user_name" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="email" class="col-md-2 control-label"><?= trans('email') ?></label>

                <div class="col-md-12">
                  <input type="email" name="email" value="<?= $user['email']; ?>" class="form-control" id="email" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="address" class="col-md-2 control-label"><?= trans('address') ?></label>

                <div class="col-md-12">
                  <input type="text" name="address" value="<?= $user['address']; ?>" class="form-control" id="address" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <label for="mobile_no" class="col-md-2 control-label"><?= trans('mobile_no') ?></label>

                <div class="col-md-12">
                  <input type="number" name="mobile_no" value="<?= $user['mobile_no']; ?>" class="form-control" id="mobile_no" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <label for="role" class="col-md-2 control-label"><?= trans('status') ?></label>

                <div class="col-md-12">
                  <select name="status" class="form-control">
                    <option value=""><?= trans('select_status') ?></option>
                    <option value="1" <?= ($user['is_active'] == 1)?'selected': '' ?> >Active</option>
                    <option value="0" <?= ($user['is_active'] == 0)?'selected': '' ?>>Deactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <input type="submit" name="submit" value="<?= trans('update_user') ?>" class="btn btn-primary pull-right">
                </div>
              </div>
            <?php echo form_close(); ?>
        </div>
          <!-- /.box-body -->
      </div>  
    </section> 
  </div>