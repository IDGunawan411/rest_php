<?php
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if($_SERVER['REQUEST_METHOD']=="DELETE"){
    $data = [];

    $_POST = json_decode(file_get_contents('php://input'), true);
    $rID   = isset($_POST['rID']) ? $_POST['rID'] : NULL;
    
    
    if($rID == NULL){
        $data['Error'] = 'Harap Masukan ID';
    }else{
        $sql = mysqli_query($koneksi, "DELETE from data_reminder WHERE id = '$rID'");

        if($sql){
            $data['Status'] = "Berhasil Delete id $rID";
        }else{
            $data['Status'] = 'Gagal';
        }
    }
    
}else{
    $data['Error'] = 'Gunakan Method DELETE';
}
echo json_encode($data);

?>