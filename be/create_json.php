<?php
header("Content-Type: application/json; charset=UTF-8");
// validasi method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'msg' => 'Method Salah !'
    ]);
    exit;
}

// Ambil raw input JSON
$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);

$errors = [];
// Validasi nama
if (!isset($data['nama'])) {
    $errors['nama'] = "Nama tidak di kirim";
} else {
    if ($data['nama'] === "") {
        $errors['nama'] = "Nama tidak boleh kosong";
    }
}

// Validasi NIM
if (!isset($data['nim'])) {
    $errors['nim'] = "nim tidak di kirim";
} else {
    if ($data['nim'] === "") {
        $errors['nim'] = "nim tidak boleh kosong";
    }
}

// Jika ada errors
if (count($errors) > 0) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'msg' => 'Data tidak valid !',
        'errors' => $errors
    ]);
    exit;
}

// Jika berhasil
echo json_encode([
    'status' => 'success',
    'errors' => $errors
]);
