<?php
header('Content-Type: application/json; charset=utf-8');
include 'koneksi.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
    $sql = mysqli_query($koneksi, "SELECT * FROM data_reminder WHERE rUserID = '$_GET[uid]' ORDER BY rTime ASC");
    $arrData = [];
    $arrData['allData'] = [];

    while($data = mysqli_fetch_array($sql)){
        $rowUlang = $data['rUlang'];
        $rUlang   = "";
        switch ($rowUlang) {
            case 'S':
                $rUlang = "Senin"
                break;
            case 'SL':
                $rUlang = "Selasa"
                break;
            case 'R': 
                $rUlang = "Rabu"
                break;
            case 'K': 
                $rUlang = "Kamis"
                break;
            case 'J': 
                $rUlang = "Jumat"
                break;
            case 'SB': 
                $rUlang = "Sabtu"
                break;
            case 'M': 
                $rUlang = "Minggu"
                break;
            default:
                $rUlang = "Setiap Hari"
                break;
        }
        array_push($arrData['allData'], (object)[
            'id' => $data['id'],
            'rNama' => $data['rNama'],
            'rKeterangan' => $data['rKeterangan'],
            'rTime' => $data['rTime'],
            'rUlang' => $rUlang
        ]);
    }

    echo json_encode($arrData);
}
?>
