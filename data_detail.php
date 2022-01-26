<?php
header('Content-Type: application/json; charset=utf-8');
include 'koneksi.php';

if($_SERVER['REQUEST_METHOD']=="GET"){
    $sql = mysqli_query($koneksi, "SELECT * FROM data_reminder WHERE id = '$_GET[id]'");
    $arrData = [];
    $arrData['detail'] = [];

    while($data = mysqli_fetch_array($sql)){
        array_push($arrData['detail'], (object)[
            'id' => $data['id'],
            'rNama' => $data['rNama'],
            'rKeterangan' => $data['rKeterangan'],
            'rUlang' => $data['rUlang'],
        ]);
    }

    echo json_encode($arrData);
}
?>