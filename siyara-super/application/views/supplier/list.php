<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Available List of suppliers</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/supplier/add'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Add New supplier</a>
            <a href="<?= base_url('admin/supplier/add'); ?>" class="btn btn-primary"><i class="fa fa-download"></i></a>
            <a href="<?= base_url('admin/supplier/add'); ?>" class="btn btn-primary"><i class="fa fa-print"></i></a>
          <?php endif; ?>
        </div>
      </div>
    </div>

<div class="datalist">
    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="50">Supplier ID</th>
                <th>Supplier Name</th>
                <th>E_mail</th>
                <th>Password</th>
                <th>Address</th>
                <th>Mobile_number</th>
                <th width="100"><?= trans('status') ?></th>
                <th width="120"><?= trans('action') ?></th>
            </tr>
        </thead>

       
        <tbody>
            <?php foreach($info as $row): ?>
            <tr>
            	<td>
					<?=$row['supplier_id']?>
                </td>
                <td>
					<h4 class="m0 mb5"><?=$row['supplier_name']?> </h4>
                   
                </td>
                <td>
                    <?=$row['e-mail']?>
                </td> 
                <td>
					<?=$row['password']?>
                </td>
                <td>
					<?=$row['address']?>
                </td>
                <td>
					<?=$row['mobile_number']?>
                </td>
                
                <td><input class='tgl tgl-ios tgl_checkbox' 
                    data-id="<?=$row['supplier_id']?>" 
                    id='cb_<?=$row['supplier_id']?>' 
                    type='checkbox' <?php echo (1 == 1)? "checked" : ""; ?> />
                    <label class='tgl-btn' for='cb_<?=$row['supplier_id']?>'></label>
                </td>
                <td>
                    <a href="<?= base_url("admin/supplier/edit/".$row['supplier_id']); ?>" class="btn btn-warning btn-xs mr5" >
                    <i class="fa fa-edit"></i>
                    </a>
                    <a href="<?= base_url("admin/supplier/delete/".$row['supplier_id']); ?>" onclick="return confirm('are you sure to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

