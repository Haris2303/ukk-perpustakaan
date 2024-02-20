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
}
