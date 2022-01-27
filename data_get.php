<?php
header('Content-Type: application/json; charset=utf-8');
include 'koneksi.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
    $sql = mysqli_query($koneksi, "SELECT * FROM data_reminder WHERE rUserID = '$_GET[uid]' ORDER BY rTime ASC");
    $arrData = [];
    $arrData['allData'] = [];

    while($data = mysqli_fetch_array($sql)){
        array_push($arrData['allData'], (object)[
            'id' => $data['id'],
            'rNama' => $data['rNama'],
            'rKeterangan' => $data['rKeterangan'],
            'rTime' => $data['rTime'],
            'rUlang' => $data['rUlang'],
        ]);
    }

    echo json_encode($arrData);
}
?>
