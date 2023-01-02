<?php
require 'koneksi.php';
if(isset($_POST["register"])){
    if(registrasi($_POST)>0){
        echo "<script>
        alert('user berhasil ditambahkan');
        </script>";
    }else{
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman registrasi</title>
</head>
<body>
    <table border="0">
    <h1>HALAMAN REGISTRASI</h1>
    <form action="" method="post">
        <tr>
            <td>
                <label for="username">Username</label>
            </td>
            <td>:</td>
            <td>
                <input type="username" name="username" id="username">
            </td>
        </tr>
        <tr>
            <td>
                <label for="password">Password</label>
            </td>
            <td>:</td>
            <td>
                <input type="password" name="password" id="password">
            </td>
        </tr>
        <tr>
            <td>
                <label for="password2">Konfirmasi Password</label>
            </td>
            <td>:</td>
            <td>
                <input type="password" name="password2" id="password2">
            </td>
        </tr>
        <tr>
            <td colspan="2"> 
                <button type="submit" name="register">Register</button>
        </td>
        <td> 
                <button><a href="login.php">Masuk</a></button>
        </td>
        </tr>
    </form>
</table>
</body>
</html>