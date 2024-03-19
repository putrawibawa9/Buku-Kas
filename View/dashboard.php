<?php
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


require_once '../Resource/header.php'; 
require_once '../Controller/Transaction.php'; 
require_once '../Controller/Category.php'; 




$category = new Category;
$category1 = $category->readcategory();

if(isset($_GET['category_id'])) {
  $category_id = $_GET['category_id'];
  $transaction = new Transaction;
  $transaction = $transaction->readEachTransaction($category_id);
} else {
  // Display all categories if no category ID is provided in the $_GET parameter
  $transaction = new Transaction;
  $transaction = $transaction->readTransaction();
}


if(isset($_POST['submit'])){
  $add = new Transaction;

  $result =$add->addTransaction($_POST);
  
  //check the progress
  if ($result){
      echo "
          <script>
          alert('data berhasil ditambah');
          document.location.href = 'dashboard.php';
          </script>
      ";
  }else{
      echo " <script>
      alert('data gagal ditambah');
      document.location.href = 'dashboard.php';
      </script>
  ";

  }

}

if(isset($_GET['filter'])){
  $filter = new Transaction;

  
  $start_date = $_GET["start_date"];
  $end_date = $_GET["end_date"];
  $transaction = $filter->readTransactionByDateRange($start_date, $end_date ); 

}


?>


    
    <div class="container">
      <div class="row">
        <div class="col-12 p-3 bg-white">
          <h3 class="text-center mb-5 mt-5">Welcome <?= $username?></h3>

          <form class="horizontal-form" method="POST" action="">
    <input type="date" id="transaction_date" name="transaction_date" required>

        <select  name="category_id" required>
            <?php foreach ($category1 as $ktg) : ?>
                <option value="<?= $ktg['category_id'] ?>"><?= $ktg['category_name'] ?> || <?= $ktg['category_id'] ?></option>
            <?php endforeach; ?>
        </select>

    <label for="input3">Nama</label>
    <input type="text" id="transaction_name" name="transaction_name" required>

    <label for="input4"> Jumlah</label>
    <input type="number" id="input4" name="transaction_amount" required>

    <label for="input5">Harga</label>
    <input type="number" id="input5" name="transaction_price" required>

    <button type="submit" class="btn btn-primary" name="submit" required >Simpan</button>
</form>


<!-- Date range filter form -->
<form class="horizontal-form mb-3" method="GET">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date"  required>

        <button type="submit" class="btn btn-primary" name="filter" >Filter</button>
      </form>


          <div class="dropdown mb-3 mt-3">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Category
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
  <?php foreach($category1 as $row):?>
    <li><a class="dropdown-item" href="dashboard.php?category_id=<?= $row["category_id"]?>"><?= $row["category_name"]?> || <?= $row["category_id"]?></a></li>
    <?php endforeach; ?>
  </ul>

  <a href="dashboard.php" class="btn btn-md btn-primary">Back</a>
</div>



          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">Date</th>
                    <th class="text-center">Transaction Name</th>                
                    <th class="text-center">Category ID</th>                  
                    <th class="text-center">Transaction Amount</th>                  
                    <th class="text-center">Transaction Price</th>                  
                    <th class="text-center">Grand Total</th>                  
                    <th class="text-center">Balance</th>                  
                    <th class="text-center">Action</th>                  
                  </tr>
            </thead>
            <tbody>
        <?php $balance = 0; ?>
              <?php foreach($transaction as $row):?>
                <tr>
                  <td class="text-center" ><?=$row['transaction_date']?></td>
                  <td ><?=$row['transaction_name']?></td>
                  <td class="text-center" ><?=$row['category_id']?></td>
                  <td class="text-center" ><?=$row['transaction_amount']?></td>
                  <td class="text-center" >Rp.<?=number_format($row['transaction_price'], 0, ".", ".")?></td>

                  <?php $grandtotal = $row['transaction_price'] * $row['transaction_amount'] ?>
                  <td class="text-center" >Rp. <?= number_format( $grandtotal, 0, ".", ".") ?></td>
                  <td> Rp.
                    <?php
                    if ($row['category_type'] == 'income') {
                    $balance += $grandtotal; // Add to balance for income
                } else {
                    $balance -= $grandtotal; // Subtract from balance for outcome
                } 
                echo number_format( $balance, 0, ".", ".")
                ?>
                  </td>
                  <td>
                        <a  href="../Controller/transactionEdit.php?transaction_id=<?=$row['transaction_id'];?>" class="btn btn-warning btn-sm ">Edit</a>
                        <a href="../Controller/transactionDelete.php?transaction_id=<?=$row['transaction_id'];?>" class="btn btn-danger btn-sm " onclick="return confirm('yakin?');">Delete</a>
                   </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
        </table>
        <div>
                
          </div>
    </div>
  </div>
</div>



<?php require_once '../Resource/footer.php';?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.category-list').addClass('active');
</script>
 
