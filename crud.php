<?php
$host ="localhost";
$user ="root";
$pass ="";
$db   ="tugas";

$koneksi =mysqli_connect($host,$user,$pass,$db);
if(!$koneksi) {//cek koneksi
die("Tidak bisa tekoneksi ke database");
}
$nama        = "";
$email       = "";
$notelp      = "";
$pekerjaan   = "";
$sukses      = "";
$error       = "";

if(isset($_GET['op'])){
    $op = $_GET['op'];
}else{
    $op ="";
}
if($op == 'delete'){
    $id    =$_GET['id'];
    $sql1  ="delete from kontak where id ='$id'";
    $q1    =mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses  ="Berhasil hapus data";
    }else{
        $error ="Gagal melakukan hapus data";
    }
}
if($op == 'edit'){
    $id        =$_GET['id'];
    $sql1      ="select *from kontak where id ='$id'";
    $q1        =mysqli_query($koneksi,$sql1);
    $r1        =mysqli_fetch_array($q1);
    $nama      =$r1['nama'];
    $email     =$r1['email'];
    $notelp    =$r1['notelp'];
    $pekerjaan =$r1['pekerjaan'];

    if($nama == ''){
        $error ="Data tidak ditemukan";

    }
}
if(isset($_POST['simpan'])){ //untuk create
    $nama           = $_POST['nama'];
    $email          = $_POST['email'];
    $notelp         = $_POST['notelp'];
    $pekerjaan      = $_POST['pekerjaan'];

    if($nama && $email && $notelp && $pekerjaan){
        if($op == 'edit'){ //untuk update
            $sql1  ="update kontak set nama ='$nama', email='$email', notelp='$notelp', pekerjaan='$pekerjaan' where id = '$id'";
            $q1    = mysqli_query($koneksi,$sql1);
            if($q1){
                $suskes = "Data berhasil diupdate";
            }else{
                $error = "Data gagal diupdate";
            }
        }else { //untuk insert
            $sql1 = "insert into kontak(nama,email,notelp,pekerjaan) values ('$nama','$email','$notelp','$pekerjaan')";
            $q1   =mysqli_query($koneksi, $sql1);
            if($q1){
               $suskes    ="Berhasil memasukan data baru";
            }else{
               $error     ="Gagal memasukkan data";
            }
        }
    }else{
        $error = "Silahkan Masukkan Data!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        .mx-auto {width:800px}
        .card { margin-top: 10px;}
    </style>
</head>
<body>
    <div class="mx-auto ">
        <!-- untuk mengeluarkan data-->
    <div class="card">
  <div class="card-header">
    Create / Edit Data
  </div>
  <div class="card-body">
  <?php
    if($error){
        ?>
        <div class="alert alert-danger" role="alert">
         <?php echo $error ?>
        </div>
        <?php
        header("refresh:5;url=index.php");//5=>detik
    }
    ?>
      <?php
    if($sukses){
        ?>
        <div class="alert alert-success" role="alert">
         <?php echo $sukses ?>
        </div>
        <?php
         header("refresh:5;url=index.php");//5=>detik
    }
    ?>

  <form action="" method="POST">
  <div class="mb-3 row">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="email" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
      <input type="text"  class="form-control" id="email" name ="email" value="<?php echo $email ?>">
    </div>
    </div>
  <div class="mb-3 row">
    <label for="notelp" class="col-sm-2 col-form-label">No Telfon</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="notelp" name="notelp" value="<?php echo $notelp ?>">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="pekerjaan" class="col-sm-2 col-form-label">Pekerjaan</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?php echo $pekerjaan ?>">
    </div>
  </div>
  <div class="col-12">
    <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary"/>
  </div>
</form>
  </div>
</div>
</div>
    
<div class="m x-auto">
        <!--untuk mengeluarkan data -->
        <div class="card">
  <div class="card-header text-white bg-secondary">
    Data User
  </div>
  <div class="card-body">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">NAMA</th>
                <th scope="col">EMAIL</th>
                <th scope="col">NO TELP</th>
                <th scope="col">PEKERJAAN</th>
                <th scope="col">AKSI</th>
            </tr>
            <tbody>
                <?php
                $sql2  = "select *from kontak order by id desc";
                $q2    = mysqli_query($koneksi, $sql2);
                $urut  = 1;
                while($r2 = mysqli_fetch_array($q2)){
                    $id          = $r2['id'];
                    $nama        = $r2['nama'];
                    $email       = $r2['email'];
                    $notelp      = $r2['notelp'];
                    $pekerjaan   = $r2['pekerjaan'];

                    ?>
                    <tr>
                        <th scope="row"><?php echo $urut++ ?></th>
                        <td scope="row"><?php echo $nama ?></td>
                        <td scope="row"><?php echo $email ?></td>
                        <td scope="row"><?php echo $notelp ?></td>
                        <td scope="row"><?php echo $pekerjaan ?></td>
                        <td scope="row">
                            <a href="index.php?op=edit&id=<?php echo $id?>"> <button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau dihapus?')"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                    </tr>
                    <?php
                } 
                ?>
            </tbody>
        </thead>

</table>
  </div>
</div>
</div>
</body>
</html>