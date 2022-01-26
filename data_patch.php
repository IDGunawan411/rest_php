<?php
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PATCH");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if($_SERVER['REQUEST_METHOD']=="PATCH"){
    $data = [];

    $_POST = json_decode(file_get_contents('php://input'), true);

    $rID         = isset($_POST['rID']) ? $_POST['rID'] : NULL;
    $rNama       = isset($_POST['rNama']) ? $_POST['rNama'] : NULL;
    $rKeterangan = isset($_POST['rKeterangan']) ? $_POST['rKeterangan'] : NULL;
    $rTime       = isset($_POST['rTime']) ? $_POST['rTime'] : NULL;
    $rUlang      = isset($_POST['rUlang']) ? $_POST['rUlang'] : NULL;

    if($rID == NULL){
        $data['Error'] = 'Harap Masukan ID';
    }else{
        $sql = mysqli_query($koneksi, "UPDATE data_reminder set rNama = '$rNama',rKeterangan = '$rKeterangan', rTime = '$rTime', rUlang = '$rUlang' 
        WHERE id = '$rID'");

        if($sql){
            $data['Data']['Nama'] = $rNama;
            $data['Data']['Keterangan'] = $rKeterangan;
            $data['Data']['Waktu'] = $rTime;
            $data['Data']['Ulang'] = $rUlang;

            $data['Status'] = 'Berhasil Update';
        }else{
            $data['Status'] = 'Gagal';
        }
    }
    
}else{
    $data['Error'] = 'Gunakan Method PATCH';
}
echo json_encode($data);

?>