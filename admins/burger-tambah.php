<?php 
    require_once '../admin/header.php';
    require_once 'classBurger.php';

    $result = new Burger;
    $data = $result->readTwoTable();



//check whether the button has been click or not
if(isset($_POST['submit'])){
    $add = new Burger;

    $result =$add->addBurger($_POST);
    
    //check the progress
    if ($result){
        echo "
            <script>
            alert('data berhasil ditambah');
            document.location.href = 'burger.php';
            </script>
        ";
    }else{
        echo " <script>
        alert('data gagal ditambah');
        document.location.href = 'burger.php';
        </script>
    ";

    }

}
?>
<div class="container">
  <div class="row">
    <div class="col-12 p-3 bg-white">
        <h3>Add Burger</h3>


        <form method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <select class="form-select" name="id_kategori" required>
            <option value=""> --Choose Burger Category--</option>
            <?php foreach ($data["tableKat"] as $jns) : ?>
                <option value="<?= $jns['id_kategori'] ?>"><?= $jns['nama_kategori'] ?> </option>
            <?php endforeach; ?>
        </select>
    </div>

            <div class="mb-3">
                <label class="form-label"> Burger Name</label>
                <input type="text" name="nama_binatang" class="form-control">
            </div>


            <label class="form-label"> Burger Descriptions</label>
            <div class="mb-3">
            <textarea class="form-control" name="keterangan_binatang" rows="3"   required></textarea>
            </div>


            <div class="mb-3">
                <label for="gambar" class="form-label">  Burger Picture</label>
                <input type="file" name="gambar" class="form-control">
            </div>

            <a href="burger.php" class="btn btn-success" >Kembali</a>
            <button type="submit" class="btn btn-primary" name="submit" >Simpan</button>
        </form>
    </div>
  </div>
</div>


<?php require_once '../admin/footer.php';?>


<script type="text/javascript">
  $('.nav-link').removeClass('active');
  $('.menu-binatang').addClass('active');
</script>