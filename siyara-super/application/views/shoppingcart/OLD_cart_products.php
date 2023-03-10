<?php
include 'functions.php';
// The amounts of products to show on each page
$num_products_on_each_page = 4;
// The current page, in the URL this will appear as index.php?page=products&p=1, index.php?page=products&p=2, etc...
$current_page = isset($_GET['p']) && is_numeric($_GET['p']) ? (int)$_GET['p'] : 1;
// Select products ordered by the date added
/*$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT ?,?');
// bindValue will allow us to use integer in the SQL statement, we need to use for LIMIT
$stmt->bindValue(1, ($current_page - 1) * $num_products_on_each_page, PDO::PARAM_INT);
$stmt->bindValue(2, $num_products_on_each_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the products from the database and return the result as an Array
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of products
$total_products = $pdo->query('SELECT * FROM products')->rowCount();

<?=template_header('Products')?>
<?=template_footer()?>
*/
$total_products=10;
?>

<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/datatables/dataTables.bootstrap4.css"> 

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content">
    <!-- For Messages -->
    <?php $this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; Available List of Products</h3>
        </div>
        <div class="d-inline-block float-right">
          <?php if($this->rbac->check_operation_permission('add')): ?>
            <a href="<?= base_url('admin/shoppingcart/cart'); ?>" class="btn btn-success"><i class="fa fa-plus"></i> Shoppingcart</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
<div  class="datalist">
    <h1>Select Products</h1>
    <p><?=$total_products?> Products Available</p>
    <div class="products-wrapper">
        <?php foreach ($info as $product): ?>
        <a href="index.php?page=product&id=<?=$product['product_id']?>" class="table-hover">
            <img src="<?=$product['photo']?>" width="200" height="200" alt="<?=$product['product_name']?>">
            <span><h4 class="m0 mb5"><?=$product['product_name']?></span>
            <span class="price">
                Rs.<?=$product['price']?>
                <?php if ($product['quantity'] > 0): ?>
                <span class="rrp">Rs.<?=$product['quantity']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
    <div class="buttons">
        <?php if ($current_page > 1): ?>
        <a href="index.php?page=products&p=<?=$current_page-1?>">Prev</a>
        <?php endif; ?>
        <?php if ($total_products > ($current_page * $num_products_on_each_page) - $num_products_on_each_page + count($info)): ?>
        <a href="index.php?page=products&p=<?=$current_page+1?>">Next</a>
        <?php endif; ?>
    </div>
</div>
