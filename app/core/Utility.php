<?php

class Utility
{

    // method upload image
    public static function uploadImage(array $dataFile, string $folderName)
    {
        // initialisasi file gambar
        $namaFile   = $dataFile['gambar']['name'];
        $ukuran     = $dataFile['gambar']['size'];
        $errorFile  = $dataFile['gambar']['error'];
        $tmpName    = $dataFile['gambar']['tmp_name'];
        $path       = LOCALE_URL . '\\img\\';

        $result = null;

        // cek gambar di upload atau tidak
        $result = ($errorFile === 4) ? 0 : $result;

        // cek ekstensi gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $result = (in_array($ekstensiGambar, $ekstensiGambarValid)) ? $result : 0;

        // cek ukuran gambar > 2mb
        $result = ($ukuran === 2000000) ? 0 : $result;

        // generate nama file baru
        $namaFileWebp = uniqid();
        $namaFileWebp .= '.' . $ekstensiGambar;

        // gambar siap upload
        if (move_uploaded_file($tmpName, $path . $folderName . '/' . $namaFileWebp)) {
            $result = $namaFileWebp;
        } else {
            $result = 0;
        }

        return $result;
    }

    public static function getKeyRandom(): string
    {
        $length = 16;
        $key = bin2hex(random_bytes($length));

        // setcookie
        setcookie('keyRandom', $key, time() + (24 * 3600));

        return $key;
    }

    public static function convertGramToKilogram(int $gram): float
    {
        return $gram / 1000;
    }

    public static function generateUUID(): string
    {
        if (function_exists('random_bytes')) {
            $data = random_bytes(16);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $data = openssl_random_pseudo_bytes(16);
        } else {
            $data = uniqid(mt_rand(), true);
        }

        assert(strlen($data) == 16);

        // Set version (4) and variant (random)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant: 10

        // Convert to UUID format (8-4-4-4-12)
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public static function generateToken(): string
    {
        // generate token
        $token = base64_encode(random_bytes(32));
        // delete character '/' and '='
        $token = trim($token, '=');
        $token = explode('/', $token); // delete character '/'
        $token = join('', $token);
        $token = explode('+', $token); // delete character '+'
        return urlencode(join('', $token));
    }

    public static function remainingTime($datetime): string
    {
        // Gunakan deadline dari database sebagai awal
        $deadline = new DateTime($datetime);

        // Dapatkan waktu saat ini
        $sekarang = new DateTime();

        // Hitung selisih waktu antara waktu saat ini dan deadline
        $selisih = $sekarang->diff($deadline);

        // sisa waktu
        $sisaWaktu = $selisih->format('%a-%h-%i');

        // pecah tiap format
        $expSisaWaktu = explode('-', $sisaWaktu);

        // cek jika sisa lebih dari 0
        $a = ($expSisaWaktu[0] > 0) ? $expSisaWaktu[0] . ' Hari' : '';
        $h = ($expSisaWaktu[1] > 0) ? $expSisaWaktu[1] . ' Jam' : '';
        $i = ($expSisaWaktu[2] > 0) ? $expSisaWaktu[2] . ' Menit' : '';

        return "$a $h $i";
    }
}
