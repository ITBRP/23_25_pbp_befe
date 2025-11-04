<?php
// validasi cek method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method Salah !']);
    exit;
}

//Mempersiapkan datanya dan variabel $data 
header("Content-Type: application/json; charset=UTF-8");
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// validasi error
$errors = [];
if (!isset($data['nim'])) {
    $errors['nim'] = "Data NIM tidak ada";
} else {
    if ($data['nim'] == '') {
        $errors['nim'] = "Data NIM tidak boleh kosong";
    }
}

if (!isset($data['nama'])) {
    $errors['nama'] = "Data NAMA tidak ada";
} else {
    if ($data['nama'] == '') {
        $errors['nama'] = "Data NAMA tidak boleh kosong";
    }
}

if (!isset($data['hp'])) {
    $errors['hp'] = "Data HP tidak ada";
} else {
    if ($data['hp'] == '') {
        $errors['hp'] = "Data HP tidak boleh kosong";
    }
}

if (!isset($data['alamat'])) {
    $errors['alamat'] = "Data ALAMAT tidak ada";
} else {
    if ($data['alamat'] == '') {
        $errors['alamat'] = "Data alamat tidak boleh kosong";
    }
}

if (count($errors) == 0) {
    // koneksi
    // $koneksi = mysqli_connect('localhost', 'root','', 'PBP_PAGIA');
    $koneksi = new mysqli('localhost', 'root','', 'PBP_PAGIA');
    // insert
    $nim = $data['nim'];
    $nama = $data['nama'];
    $hp = $data['hp'];
    $alamat = $data['alamat'];
    $q = "INSERT INTO mahasiswa (nim, nama, hp, alamat) VALUES('$nim','$nama','$hp','$alamat')";
    // mysqli_query($koneksi, $q);
    $koneksi->query($q);
    $dataResponse = [
        'status' => 'success',
        'msg' => 'Data baru berhasil dibuat',
        'data' => [
            'id' => $koneksi->insert_id,
            'nim' => $data['nim'],
            'nama' => $data['nama'],
            'hp' => $data['hp'],
            'alamat' => $data['alamat'],
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

echo json_encode($dataResponse);
