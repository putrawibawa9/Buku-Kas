<?php 
require_once '../Resource/header.php'; 
require_once '../Controller/Transaction.php'; 
require_once '../Controller/Category.php'; 
?>

<?php
$transaction_id = $_GET['transaction_id'];

$transactions = new Transaction;

$transaction = $transactions->readEachTransaction($transaction_id);

$category_type = $transaction['category_type'];
$datakategori = new Category;
$categories = $datakategori->readCategoryOnType($category_type);
if(isset($_POST['submit'])){

    $edit = new Transaction;
    $result = $edit->editTransaction($_POST);
    
    //check the progress
    if ($result){
        echo "
            <script>
            alert('data berhasil diubah');
            document.location.href = 'dashboard.php';
            </script>
        ";
    }else{
        echo " <script>
        alert('data gagal diubah');
        document.location.href = 'dashboard.php';
        </script>
    ";

    }

}

?>
<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <h3>Edit Transaction</h3>


        <form method="post" enctype="multipart/form-data">

        <input type="hidden" name="transaction_id" value="<?= $transaction_id ?>;">

 


            <div class="mb-3">
                <label class="form-label"> Transaction Name</label>
                <input type="text" name="transaction_name" class="form-control" value="<?= $transaction['transaction_name']?>">
            </div>


            <div class="mb-3">
                <label class="form-label"> Transaction Date</label>
                <input type="date" name="transaction_date" class="form-control" value="<?= $transaction['transaction_date']?>">
            </div>

            <div class="mb-3">
        <select class="form-select" name="category_id" required>
            <option value="<?= $transaction['category_id']?>"><?= $transaction['category_name']?> </option>
            <?php foreach ($categories as $ktg) : ?>
                <option value="<?= $ktg['category_id'] ?>"><?= $ktg['category_name'] ?> </option>
            <?php endforeach; ?>
        </select>
    </div>
            
    <div class="mb-3">
                <label class="form-label"> Transaction Amount</label>
                <input type="number" name="transaction_amount" class="form-control" value="<?= $transaction['transaction_amount']?>">
            </div>

     <div class="mb-3">
                <label class="form-label"> Transaction Price</label>
                <input type="number" name="transaction_price" class="form-control" value= "<?= $transaction['transaction_price']?>">
     </div>
            

            <a href="dashboard.php" class="btn btn-success" >Back</a>
            <button type="submit" class="btn btn-primary" name="submit" >Save</button>
        </form>
    </div>
  </div>
</div>


<?php require_once '../Resource/footer.php';?>

<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-binatang').addClass('active');
</script>
