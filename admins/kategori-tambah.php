<?php 
    require_once '../admin/header.php';
    require_once 'classCategory.php';

    if(isset($_POST['submit'])){
        $nama_kategori = $_POST["nama_kategori"];
        $addKategori = new Kategori;
        $addKategori->addKategori($nama_kategori);
}
?>

<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <h3>Burger Category</h3>
        <form action="" method="post">  
            <div class="mb-3">
                <input type="text" name="nama_kategori" placeholder=" Add Burger Category" class="form-control" required>
            </div>
            <a href="kategori.php" class="btn btn-success" >Back</a>
            <button type="submit" class="btn btn-primary" name="submit" >Save</button>
        </form>
    </div>
  </div>
</div>


<?php require_once '../admin/footer.php';?>

<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-category').addClass('active');
</script>