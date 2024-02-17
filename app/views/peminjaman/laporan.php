<?php

//instantisasi objek
$pdf = $data['pdf'];

// Mulai dokumen
$pdf->AddPage('P', 'A4');
//meletakkan gambar
$pdf->letak(LOCALE_URL . '/report/img/logo-pplg.png');
//meletakkan judul disamping logo diatas
$pdf->judul(strtoupper("APLIKASI PERPUSTAKAAN"), 'UJI KOMPETENSI KEAHLIAN', 'SMK NEGERI 1 KOTA SORONG', 'Jl. Pendidikan KM.8 Klasaman Sorong Timur Kota Sorong Telp. 0951324342', 'Website: http://www.smkn1sorong.sch.id | E-Mail:
smkn1bpsorong@yahoo.com');
//membuat garis ganda tebal dan tipis
$pdf->garis();
$pdf->content($data['data_content']);
$pdf->akhir();

$pdf->Output(strtolower("laporan_peminjaman"), 'I');
?>