<?php
$requestBody = file_get_contents('php://input');
$data = json_decode($requestBody, true);
var_dump($data);
$errors = [];
if (!isset($_POST['nim'])) {
    $errors['nim'] = "Data NIM tidak ada";
} else {
    if ($_POST['nim'] == '') {
        $errors['nim'] = "Data NIM tidak boleh kosong";
    }
}

if (!isset($_POST['nama'])) {
    $errors['nama'] = "Data NAMA tidak ada";
} else {
    if ($_POST['nama'] == '') {
        $errors['nama'] = "Data NAMA tidak boleh kosong";
    }
}

if (!isset($_POST['hp'])) {
    $errors['hp'] = "Data HP tidak ada";
} else {
    if ($_POST['hp'] == '') {
        $errors['hp'] = "Data HP tidak boleh kosong";
    }
}

if (!isset($_POST['alamat'])) {
    $errors['alamat'] = "Data ALAMAT tidak ada";
} else {
    if ($_POST['alamat'] == '') {
        $errors['alamat'] = "Data alamat tidak boleh kosong";
    }
}

if (count($errors) == 0) {
    // koneksi
    // $koneksi = mysqli_connect('localhost', 'root','', 'PBP_PAGIA');
    $koneksi = new mysqli('localhost', 'root','', 'PBP_PAGIA');
    // insert
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $hp = $_POST['hp'];
    $alamat = $_POST['alamat'];
    $q = "INSERT INTO mahasiswa (nim, nama, hp, alamat) VALUES('$nim','$nama','$hp','$alamat')";
    // mysqli_query($koneksi, $q);
    $koneksi->query($q);
    $dataResponse = [
        'status' => 'success',
        'msg' => 'Data baru berhasil dibuat',
        'data' => [
            'id' => $koneksi->insert_id,
            'nim' => $_POST['nim'],
            'nama' => $_POST['nama'],
            'hp' => $_POST['hp'],
            'alamat' => $_POST['alamat'],
        ]
    ];
} else {
    $dataResponse = [
        'status' => 'error',
        'msg' => 'Validasi Error',
        'errors' => $errors
    ];
    http_response_code(400);
}

header('Content-Type: application/json');
echo json_encode($dataResponse);
