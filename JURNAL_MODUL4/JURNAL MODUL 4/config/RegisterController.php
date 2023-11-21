<?php

require 'connect.php';

// (1) Mulai session
session_start();

// (2) Ambil nilai input dari form registrasi

    // a. Ambil nilai input email
    // b. Ambil nilai input name
    // c. Ambil nilai input username
    // d. Ambil nilai input password
    // e. Ubah nilai input password menjadi hash menggunakan fungsi password_hash()
    $email = $_POST['email'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
//

// (3) Buat dan lakukan query untuk mencari data dengan email yang sama dari nilai input email
$query1 = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($db, $query1);
//

// (4) Buatlah perkondisian ketika tidak ada data email yang sama ( gunakan mysqli_num_rows == 0 )
if (mysqli_num_rows($result)== 0){

    // a. Buatlah query untuk melakukan insert data ke dalam database
    $query2 ="INSERT INTO users (name, username, email, password) VALUES('$name', '$username', '$email', '$password')";

    // b. Buat lagi perkondisian atau percabangan ketika query insert berhasil dilakukan
    //    Buat di dalamnya variabel session dengan key message untuk menampilkan pesan penadftaran berhasil
    $insert = mysqli_query($db, $query2);
// 

// (5) Buat juga kondisi else
//     Buat di dalamnya variabel session dengan key message untuk menampilkan pesan error karena data email sudah terdaftar
    if ($insert){
        $_SESSION['message'] = 'Pendaftaran sukses, silahkan login';
        $_SESSION['color'] = 'susses';
        header('Location: ../views/login.php');

    }else{
        $_SESSION['message'] = 'Pendaftaran Gagal';

    }        
}
else{
    $_SESSION['message'] = 'Username Sudah Terdaftar';
    header('Location: ../views/register.php');
}
//


?>