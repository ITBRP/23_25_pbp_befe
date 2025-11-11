<?php
header("Content-Type: application/json; charset=UTF-8");
// validasi cek method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error', 
        'msg' => 'Method Salah !'
    ]);
    exit;
}

$errors = [];
if(!isset($_POST['nama'])){
    $errors['nama'] = "Nama tidak di kirim";
}else{
    if($_POST['nama']==""){
        $errors['nama'] = "Nama tidak boleh kosong";
    }
}

if(!isset($_POST['nim'])){
    $errors['nim'] = "nim tidak di kirim";
}else{
    if($_POST['nim']==""){
        $errors['nim'] = "nim tidak boleh kosong";
    }
}

if(count($errors)>0){
    http_response_code(400);
    echo json_encode([
        'status' => 'error', 
        'msg' => 'Data tidak valid !',
        'errors' => $errors
    ]);
    exit;
}

echo json_encode([
    'status' => 'success', 
    'errors' => $errors
]);

// $errors = [];
// if (!isset($_POST['nama'])) {
//     $errors['nama'] = "Data Nama tidak ada";
// } else {
//     if ($_POST['nama'] == '') {
//         $errors['nama'] = "Data Nama tidak boleh kosong";
//     }
// }
// if (!isset($_POST['nim'])) {
//     $errors['nim'] = "Data NIM tidak ada";
// } else {
//     if ($_POST['nim'] == '') {
//         $errors['nim'] = "Data NIM tidak boleh kosong";
//     }
// }

// if (count($errors) > 0) {
//     $dataResponse = [
//         'status' => 'error',
//         'msg' => 'Validasi Error',
//         'errors' => $errors
//     ];
//     http_response_code(400);
// }

//     // koneksi
//     $koneksi = new mysqli('localhost', 'root','', 'PBP_PAGIA');
//     // insert
//     $nim = $data['nim'];
//     $nama = $data['nama'];
//     $q = "INSERT INTO mahasiswa (nim, nama) VALUES('$nim','$nama')";
//     // mysqli_query($koneksi, $q);
//     $koneksi->query($q);
//     $dataResponse = [
//         'status' => 'success',
//         'msg' => 'Data baru berhasil dibuat',
//         'data' => [
//             'id' => $koneksi->insert_id,
//             'nim' => $data['nim'],
//             'nama' => $data['nama'],
//         ]
//     ];


// echo json_encode($dataResponse);

