<?php 
    require_once '../admin/header.php';
    require_once 'classCategory.php'; 

$id_kategori = $_GET['id_kategori'];

$viewEachCategory = new Kategori;

$kategori =$viewEachCategory->viewEachCategory($id_kategori);


if(isset($_POST['submit'])){
    $nama_kategori = $_POST["nama_kategori"];
   $editKategori = new Kategori;
   
   $editKategori->editKategori($nama_kategori,$id_kategori);
   
}
?>
<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <h3>Edit Kategori Kopi</h3>
        <form action="" method="post"`>  
        <input type="hidden" name="id_kategori" value="<?= $id_kategori ?>;">
                
            <div class="mb-3">
                <input type="text" name="nama_kategori" placeholder="kategori" class="form-control" value ="<?= $kategori['nama_kategori']?> " required>
            </div>
            <a href="kategori.php" class="btn btn-success" >Kembali</a>
            <button type="submit" class="btn btn-primary" name="submit" >Simpan</button>
        </form>
    </div>
  </div>
</div>


<?php require_once '../admin/footer.php';?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-category').addClass('active');
</script>