<?php

//include master file
require_once(LOCALE_URL . '/report/fpdf/fpdf.php');

class Laporan extends FPDF
{

    public function __construct()
    {
        parent::__construct();
    }

    public function letak($gambar)
    {
        //memasukkan gambar untuk header
        $this->Image($gambar, 25, 5, 30, 30);
        //menggeser posisi sekarang
    }
    public function judul($teks1, $teks2, $teks3, $teks4, $teks5)
    {
        $this->Cell(25);
        $this->SetFont('Times', 'B', '14');
        $this->Cell(0, 5, $teks1, 0, 1, 'C');
        $this->Ln(2);
        $this->Cell(25);
        $this->Cell(0, 5, $teks2, 0, 1, 'C');
        $this->Ln(2);
        $this->Cell(25);
        $this->SetFont('Times', 'B', '16');
        $this->Cell(0, 5, $teks3, 0, 1, 'C');
        $this->Cell(25);
        $this->SetFont('Times', 'I', '8');
        $this->Cell(0, 5, $teks4, 0, 1, 'C');
        $this->Cell(25);
        $this->Cell(0, 2, $teks5, 0, 1, 'C');
    }
    public function garis()
    {
        $this->SetLineWidth(1);
        $this->Line(20, 39, 190, 39);
        $this->SetLineWidth(0);
        $this->Line(20, 40, 190, 40);

        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(180, 20, 'Sorong, ' . date('d M Y'), 0, 1, 'R');
        $this->Ln(-10);
    }

    public function blackContent()
    {
        $view = new Controller();
        echo $view->view('error/404', ["msg" => "Tidak ada data..."]);
        exit;
    }

    public function setContent(array $data)
    {
        $this->Ln(20);

        $h1 = 8;
        $w1 = 6;
        $w2 = 40;
        $w3 = 25;

        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 0, 'Data Peminjaman ', 0, 1, 'C');
        $this->Ln(10);

        // Header tabel
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(2);
        $this->Cell($w1, $h1, 'No', 1, 0, 'C');
        $this->Cell($w2, $h1, 'Nama Peminjam', 1, 0);
        $this->Cell($w2, $h1, 'Judul Buku ', 1, 0);
        $this->Cell($w2, $h1, 'Tanggal Peminjaman', 1, 0);
        $this->Cell($w2, $h1, 'Tanggal Pengembalian', 1, 0);
        $this->Cell($w3, $h1, 'Status', 1, 1);

        $this->SetFont('helvetica', '', 7);

        $no = 1;
        foreach ($data as $item) {
            $this->Cell(2);
            $this->Cell($w1, $h1, $no++, 1, 0, 'C');
            $this->Cell($w2, $h1, $item['NamaLengkap'], 1, 0);
            $this->Cell($w2, $h1, $item['Judul'], 1, 0);
            $this->Cell($w2, $h1, $item['TanggalPeminjaman'], 1, 0);
            $this->Cell($w2, $h1, $item['TanggalPengembalian'], 1, 0);
            $this->Cell($w3, $h1, $item['StatusPeminjaman'], 1, 1);
        }
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(2);
    }

    public function content(array $data)
    {
        // jika ada kosong
        if (empty($data)) {
            $this->blackContent();
        } else {
            $this->setContent($data);
        }
    }

    public function akhir()
    {
        $w = 190;
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell($w - 5, 30, 'Kepala Pimpinan', 0, 1, 'R');
        $this->Ln(15);
        $this->Cell($w, 0, 'Dr. Otong Surotong ST. MT.', 0, 1, 'R');
        $this->Cell($w, 10, 'NRP. 20170526001', 0, 1, 'R');
    }
}