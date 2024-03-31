<?php
require_once '../Resource/header.php'; 
require_once '../Controller/Transaction.php'; 
require_once '../Controller/Category.php'; 
require_once '../Controller/Total.php'; 

session_start();

if (isset($_SESSION['username'])) {
  $username = $_SESSION["username"];
} else {
  echo "
  <script>
  document.location.href = '../index.php';
  </script>
";
}

if(isset($_GET['submit'])){

  $category_type = $_GET['category_type'];

  $filterall = new Total;

  $filter = $filterall->readCategoryBased($category_type);
  
  $sum = $filterall->sumTotalCategory($category_type);

  var_dump($sum);
  exit;
}



$income = new Transaction;
$income = $income->readIncome();


$outcome = new Transaction;
$outcome = $outcome->readOutcome();

$allCategory = new Category;
$all_Category = $allCategory->readcategory();



$sumCategory = new Category;

$category = $sumCategory->sumEachCategory('P001');
?>



<div class="container">
    <div class="row">
    <h3 class="text-center mb-5 mt-5">BUKU KAS 2024</h3>
      <div class="col-md-6">
        <table class="table">
          <thead>
            <tr>
              <th class="text-center">Total Income</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center"> Rp.<?= number_format($income, 0, ',', '.')?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-6">
      <table class="table">
          <thead>
            <tr>
              <th class="text-center">Total Outcome</th>
            </tr>
          </thead>
          <tbody>
            <tr>
            <td class="text-center"> Rp.<?= number_format($outcome, 0, ',', '.')?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>


  </div>

  
  <div class="container">
    <div class="row">
      <!-- First column -->
      <div class="col-md-6 border">
        <h2>Category</h2>
        <?php foreach($all_Category as $row):?>
        <p class="border"><?= $row['category_name']?></p>
        <?php endforeach; ?>
      </div>
      <!-- Second column -->

      <div class="col-md-6 border">
        <h2>Total</h2>
        <?php foreach($all_Category as $row):?>
        <p><?php $category = $sumCategory->sumEachCategory($row["category_id"]);
        
        echo "Rp. $category[0]"
        ?></p>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <a href="dashboard.php" class="btn btn-md btn-primary">Back</a>





<?php require_once '../Resource/footer.php';?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.category-list').addClass('active');
</script>
 
