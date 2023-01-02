<?php
include 'koneksi.php';

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");

    //cek username
    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])){
            header("Location: crud.php");
            exit;
        }
    }
    $error = true;
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
    <h1>HALAMAN LOGIN</h1>
    <?php
    if(isset($error)): ?>
    <p>Username / Password anda salah</p>
    <?php endif; ?>
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
                <button type="submit" name="login">LOGIN</button>
        </td>
        <td> 
                <button><a href="registrasi.php">Register</a></button>
        </td>
        </tr>
    </form>
</table>
</body>
</html>