<?php
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $data = [];

    $_POST = json_decode(file_get_contents('php://input'), true);

    $rNama       = isset($_POST['rNama']) ? $_POST['rNama'] : NULL;
    $rKeterangan = isset($_POST['rKeterangan']) ? $_POST['rKeterangan'] : NULL;
    $rTime       = isset($_POST['rTime']) ? $_POST['rTime'] : NULL;
    $rUlang      = isset($_POST['rUlang']) ? $_POST['rUlang'] : NULL;

    if($rNama == NULL){
        $data['Error'] = 'Harap Masukan Nama';
    }else{
        $sql = mysqli_query($koneksi, "INSERT INTO data_reminder VALUES(null,'$rNama','$rKeterangan','$rTime','$rUlang')");

        if($sql){
            $data['Data']['Nama'] = $rNama;
            $data['Data']['Keterangan'] = $rKeterangan;
            $data['Data']['Waktu'] = $rTime;
            $data['Data']['Ulang'] = $rUlang;
    
            $data['Status'] = 'Berhasil Add';
        }else{
            $data['Status'] = 'Gagal';
        }
    }
    
}else{
    $data['Error'] = 'Gunakan Method POST';
}
echo json_encode($data);

?>