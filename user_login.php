<?php
include 'koneksi.php';
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
if($_SERVER['REQUEST_METHOD']=="POST"){
    $data = [];

    $_POST = json_decode(file_get_contents('php://input'), true);

    $uUsername   = isset($_POST['uUsername']) ? $_POST['uUsername'] : NULL;
    $uPassword   = isset($_POST['uPassword']) ? $_POST['uPassword'] : NULL;
  
    if($uUsername == NULL || $uPassword == NULL){
        $data['Error'] = 'Harap Masukan Username/Password';
    }else{
        $sql = mysqli_query($koneksi, "SELECT * FROM data_user WHERE uUsername = '$uUsername' AND uPassword = '$uPassword'");
        $rowcount=mysqli_num_rows($result);
        $row=mysqli_fetch_array($result);
        
        if($rowcount > 0){
            $data['Data']['uNama'] = $row['uNama'];
            $data['Data']['uUsername'] = $row['uUsername'];
            $data['Data']['uPassword'] = $row['uPassword'];
    
            $data['Status'] = '1';
        }else{
            $data['Status'] = 'Gagal';
        }
    }
    
}else{
    $data['Error'] = 'Gunakan Method POST';
}
echo json_encode($data);

?>
