<?php
require_once '../Resource/header.php'; 
require_once '../Controller/Transaction.php'; 
require_once '../Controller/Category.php'; 

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

$income = new Transaction;
$income = $income->readIncome();


$outcome = new Transaction;
$outcome = $outcome->readOutcome();


$category = new Category;
$all_category = $category->readcategory();
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

    <div class="dropdown mb-3 mt-3">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Category
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <?php foreach($category1 as $row):?>
    <li><a class="dropdown-item" href="dashboard.php?category_id=<?= $row["category_id"]?>"><?= $row["category_name"]?> || <?= $row["category_id"]?></a></li>
    <?php endforeach; ?>
  </ul>
  </div>
    <form method="POST" action="">
    <select  name="transaction_type" required>
                <option value="income">Income</option>
                <option value="outcome">Outcome</option>
        </select>
        </form>
  </div>

  
  <div class="container">
    <div class="row">
      <!-- First column -->
      <div class="col-md-6 border">
        <h2>Category</h2>
        <?php foreach($all_category as $row):?>
        <p class="border"><?= $row['category_name']?></p>
        <?php endforeach; ?>
      </div>
      <!-- Second column -->
      <div class="col-md-6 border">
        <h2>Total</h2>
        <p>This is the content of the second column. You can add any content here.</p>
      </div>
    </div>
  </div>
  <a href="dashboard.php" class="btn btn-md btn-primary">Back</a>





<?php require_once '../Resource/footer.php';?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.category-list').addClass('active');
</script>
 
