<?php
require_once "../construct.php";
class Burger extends Connect{
    
    public function readBurger(){
        $conn = $this->getConnection();
        $query = "SELECT * FROM binatang JOIN kategori ON binatang.id_kategori = kategori.id_kategori";  
        $result = $conn->query($query);
        $burger = $result->fetchAll();
        return $burger;
        }

    public function readTwoTable(){
        $conn = $this->getConnection();
        $queryKat = "SELECT * FROM kategori";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang";
        $resultBin = $conn->query($queryBin);


        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetchAll();
            $dataBin = $resultBin->fetchAll();
            return array('tableKat'=>$dataKat, 'tableBin'=>$dataBin);
        }else{
            return false;
        }
    }
    public function readTwoTablepart2($id_binatang){
        $conn = $this->getConnection();
        $queryKat = "SELECT * FROM kategori JOIN binatang ON kategori.id_kategori = binatang.id_kategori WHERE id_binatang = $id_binatang";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang WHERE id_binatang= $id_binatang";
        $resultBin = $conn->query($queryBin);



        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetch();
            $dataBin = $resultBin->fetch();
            return array('tableKat'=>$dataKat, 'tableBin'=>$dataBin);
        }else{
            return false;
        }
    }

    public function readTwoTablepart3($id_kategori){
        $conn = $this->getConnection();
        $queryKat = "SELECT nama_kategori FROM kategori WHERE id_kategori = $id_kategori";
        $resultKat = $conn->query($queryKat);

        $queryBin = "SELECT * FROM binatang JOIN kategori ON binatang.id_kategori = kategori.id_kategori WHERE kategori.id_kategori = $id_kategori";
        $resultBin = $conn->query($queryBin);

        if($resultKat && $resultBin){
            $dataKat = $resultKat->fetch();
            $dataBin = $resultBin->fetchall();
            return array('tableKat'=>$dataKat, 'tableBin'=>$dataBin);
        }else{
            return false;
    }
}

    public function addBurger($data){
        $conn = $this->getConnection();
        $nama_binatang = $data['nama_binatang'];
        $keterangan_binatang = $data['keterangan_binatang'];
        $id_kategori = $data['id_kategori'];
        $gambar = $this->uploadGambar();
        if (!$gambar) {
            return false;
        }


        $query = "INSERT INTO binatang VALUES 
        ('',?,?,?,?)";
    
        $stmt = $conn->prepare($query);
    
        $stmt->bindParam(1,$nama_binatang);
        $stmt->bindParam(2,$keterangan_binatang);
        $stmt->bindParam(3,$gambar);
        $stmt->bindParam(4,$id_kategori);
        $stmt->execute();
        return true;
    }


    public function editBurger($data){
        $conn = $this->getConnection();
        $nama_binatang = $data['nama_binatang'];
        $keterangan_binatang = $data['keterangan_binatang'];
        $id_binatang = $data['id_binatang'];
        $gambarLama = $data['gambarLama'];
        $id_kategori = $data['id_kategori'];

          //check whether user pick a new image or not
        if($_FILES['gambar']['error']===4){
            $gambar = $gambarLama;
        }else{
            $gambar = $this->uploadGambar();
        }
        $query = "UPDATE binatang SET
        nama_binatang = ?,
        keterangan_binatang = ?,
        gambar = ?,
        id_kategori = ?
        WHERE id_binatang = ?
        ";
             $stmt = $conn->prepare($query);
                $stmt->bindParam(1,$nama_binatang);
                $stmt->bindParam(2,$keterangan_binatang);
                $stmt->bindParam(3,$gambar);
                $stmt->bindParam(4,$id_kategori);
                $stmt->bindParam(5,$id_binatang);
                $stmt->execute();
                return true;
    }
    public function uploadGambar(){
        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile =  $_FILES['gambar']['size'];
        $error =  $_FILES['gambar']['error'];  
        $tmp =  $_FILES['gambar']['tmp_name'];  
      
        //cek apakah user sudah menambah gambar
      
        if($error ===4){
          echo "<script>
              alert ('Silahkan pilih gambar');
                </script>";
                return false;
        }
      
        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid =['jpg','jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile); 
        $ekstensiGambar = strtolower(end($ekstensiGambar)); 
        if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
          echo "<script>
              alert ('format gambar salah!');
                </script>";
                return false;
        }
      
        //cek jika ukurannya terlalu besar
        if ($ukuranFile > 1000000){
          echo "<script>
              alert ('Ukuran terlalu besar');
                </script>";
        }
      
        //generate nama file random
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
      
      
        //lolos semua hasil cek, lalu dijalankan
        move_uploaded_file($tmp, '../img/'.$namaFileBaru);
      
        return $namaFileBaru;
    }


    public function deleteBurger($id_binatang){
        $conn = $this->getConnection();
        $query = "DELETE FROM binatang WHERE id_binatang = $id_binatang";
        $result = $conn->exec($query);
        return $result;
}

    public function viewEachCategory($id_kategori){
        $conn = $this->getConnection();
        $query = "SELECT * FROM kategori WHERE id_kategori= $id_kategori";
        $result = $conn->query($query);
        $kategori = $result->fetch();
        return $kategori;
    }

    public function editKategori($nama_kategori,$id_kategori){
        $conn = $this->getConnection();
        $query = "UPDATE kategori SET
        nama_kategori = ?
        WHERE id_kategori = ?";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1,$nama_kategori);
         $stmt->bindParam(2,$id_kategori);

          //check the progress
    if ($stmt->execute()) {
        echo "
            <script>
            alert('Data berhasil diupdate');
            document.location.href = 'kategori.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Data gagal diupdate');
            document.location.href = 'kategori.php';
            </script>
        ";
    }
    }

}
?>