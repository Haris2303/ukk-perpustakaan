<?php
//include master file
require_once('./fpdf/fpdf.php');

class pdf extends FPDF
{
    function letak($gambar)
    {
        //memasukkan gambar untuk header
        $this->Image($gambar, 10, 10, 20, 25);
        //menggeser posisi sekarang
    }
    function judul($teks1, $teks2, $teks3, $teks4, $teks5)
    {
        $this->Cell(25);
        $this->SetFont('Times', 'B', '12');
        $this->Cell(0, 5, $teks1, 0, 1, 'C');
        $this->Cell(25);
        $this->Cell(0, 5, $teks2, 0, 1, 'C');
        $this->Cell(25);
        $this->SetFont('Times', 'B', '15');
        $this->Cell(0, 5, $teks3, 0, 1, 'C');
        $this->Cell(25);
        $this->SetFont('Times', 'I', '8');
        $this->Cell(0, 5, $teks4, 0, 1, 'C');
        $this->Cell(25);
        $this->Cell(0, 2, $teks5, 0, 1, 'C');
    }
    function garis()
    {
        $this->SetLineWidth(1);
        $this->Line(10, 36, 138, 36);
        $this->SetLineWidth(0);
        $this->Line(10, 37, 138, 37);
    }

    function content()
    {
        $gh = $_GET['id'];
        $this->Ln(10);

        // Header tabel
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(15, 6, 'Nomor', 1, 0);
        $this->Cell(25, 6, 'Nik', 1, 0);
        $this->Cell(53, 6, 'Nama Peserta', 1, 0);
        $this->Cell(10, 6, 'Nilai', 1, 0);
        $this->Cell(25, 6, 'Jenis Tes', 1, 1);

        $this->SetFont('helvetica', '', 10);

        // koneksi ke database
        include '../../config/db.php';
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        $no = 1;
        $tampil = mysqli_query($con, "SELECT nama, nik, nilai, jenistes FROM data_pribadi INNER JOIN datanilai ON data_pribadi.nik = datanilai.nik_dn WHERE jenistes='$gh'");
        while ($hasil = $tampil->fetch_assoc()) {
            $this->Cell(15, 6, $no++, 1, 0);
            $this->Cell(25, 6, $hasil['nik'], 1, 0);
            $this->Cell(53, 6, $hasil['nama'], 1, 0);
            $this->Cell(10, 6, $hasil['nilai'], 1, 0);
            $this->Cell(25, 6, $hasil['jenistes'], 1, 1);
        }
    }

    function akhir()
    {
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 25, 'Direktur RS Maleo', 0, 1, 'R');
        $this->Cell(40);
        $this->Cell(0, 0, 'Dr. Irene S. Dawenan', 0, 1, 'R');
        $this->Cell(0, -10, 'NRP. 20170526001', 0, 1, 'R');
    }
}
//instantisasi objek
$pdf = new pdf();

//Mulai dokumen
$pdf->AddPage('P', 'A5');
//meletakkan gambar
$pdf->letak('img/logo.png');
//meletakkan judul disamping logo diatas
$pdf->judul('PEMERINTAH KOTA PAGAR ALAM', 'DINAS PENDIDIKAN', 'SEKOLAH MENENGAH ATAS NEGERI 4', 'Jambat Balo Pagar Alam
Selatan Kota Pagar Alam Telp. (0730)622442', 'Website: http://sman4pagaralam.sch.id | E-Mail:
smanegeri4pagaralam@gmail.com');
//membuat garis ganda tebal dan tipis
$pdf->garis();
$pdf->content();
$pdf->akhir();

$pdf->Output('hasilunsman4pga.pdf', 'I');
?>