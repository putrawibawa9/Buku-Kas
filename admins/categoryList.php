<?php
require_once 'classBurger.php'; 
require_once '../admin/header.php'; 


$hasil = new Burger;
$burger = $hasil->readBurger();
?>


  
    
    <div class="container">
      <div class="row">
        <div class="col-12 p-3 bg-white">
          <h3>Burger</h3>
          <a href="burger-tambah.php" class="btn btn-primary  mb-3">Add</a>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th class="text-center">ID</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Burger Name</th>
                    <th class="text-center">Descriptions</th>
                    <th class="text-center">Picture</th>
                    <th class="text-center">Options</th>
                    
                  </tr>
            </thead>
            <tbody>
              <?php foreach($burger as $row):?>
                <tr>
                  <td class="text-center" ><?=$row['id_binatang']?></td>
                  <td ><?=$row['nama_kategori']?></td>
                  <td ><?=$row['nama_binatang']?></td>
                  <td ><?=$row['keterangan_binatang']?></td>
                  <td class="text-center" > <img src="../img/<?=$row['gambar']?>" width="100px"></td>
                   <td>
                    <a  href="burger-form.php?id_binatang=<?=$row['id_binatang'];?>" class="btn btn-warning btn-sm ">Edit</a>
                    <a href="binatang-delete.php?id_binatang=<?=$row['id_binatang'];?>" class="btn btn-danger btn-sm " onclick="return confirm('yakin?');">Delete</a>
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



<?php require_once '../admin/footer.php';?>

<?php require_once '../admin/footer.php';?>
<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-binatang').addClass('active');
</script>
 
