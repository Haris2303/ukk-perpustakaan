<?php

class BaseModel
{
    public $db;
    protected $table;

    public function __construct()
    {
        $this->db = new Database();
        // $this->table = $table;
    }

    /**
     * Memeriksa apakah data ada dalam tabel berdasarkan kondisi yang diberikan.
     *
     * @param array $kondisi Kondisi WHERE dalam bentuk array (contoh: ["kolom" => "nilai"]).
     * @return bool True jika data ditemukan, false jika tidak.
     */
    public function isData(array $kondisi): bool
    {
        // tangkap key dan value dari array kondisi
        $key = array_keys($kondisi)[0];
        $value = array_values($kondisi)[0];
        // init query
        $query = "SELECT * FROM $this->table WHERE $key = ?";
        // prepare query
        $this->db->query($query);
        // binding
        $this->db->bind(1, $value);
        // execute
        $this->db->execute();
        // kembalikan true jika bukan boolean dan kembalikan false jika boolean
        return (!is_bool($this->db->single())) ? true : false;
    }

    /**
     * Memilih data dari tabel atau view dengan kriteria tertentu.
     *
     * @param string|null $view Nama view yang ingin ditampilkan. Default null untuk menggunakan tabel utama.
     * @param string|null $select Field yang ingin ditampilkan. Default null untuk menampilkan semua field.
     * @param array $orderBy Pengurutan data. Default "[]" jika tidak diberikan.
     * @param array|null $kondisi Kondisi WHERE dalam bentuk array (contoh: ["kolom =" => "nilai"]). Default null jika tidak ada kondisi.
     * @param string $limit Membatasi data yang tampil default string kosong `""`, berikut contoh parameter yang diberikan `"LIMIT 5"`
     * @return void
     * 
     * @continue Lanjutkan dengan fungsi berikutnya seperti "fetchAll" atau "fetch".
     */
    public function selectData(string $view = null, string $select = null, array $orderBy = [], array $kondisi = null, string $limit = ''): void
    {
        // set table 
        $table = (!is_null($view)) ? $view : $this->table;

        // set field selection
        $setSelect = (!is_null($select)) ? $select : "*";

        // init order
        $setOrder = "";

        // jika order by ada
        if (count($orderBy) > 0) {

            // set key dan value order
            $keyOrder = array_keys($orderBy)[0];
            $valueOrder = array_values($orderBy)[0];

            $setOrder = "ORDER BY $keyOrder $valueOrder";
        }

        // query awal 
        $query = "SELECT $setSelect FROM $table $setOrder $limit";

        // cek kondisi where
        if (!is_null($kondisi)) {

            // ambil gerbang logika AND | OR 
            // set index $i
            if (array_key_exists("logic", $kondisi)) {
                $logic = $kondisi['logic'];
                $i = 1;
            } else {
                $logic = "";
                $i = 0;
            };

            // ambil key dan value dari kondisi
            $arr = [];
            for ($i; $i <= count($kondisi) - 1; $i++) {
                $arr += [array_keys($kondisi)[$i] => array_values($kondisi)[$i]];
            }

            // set where kondisi
            $setKondisi = implode(" ? $logic ", array_keys($arr)) . " ? ";

            // buat query
            $query = "SELECT $setSelect FROM $table WHERE ($setKondisi) $setOrder $limit";

            // siapkan query
            $this->db->query($query);

            // binding
            $i = 1;
            foreach ($arr as $value) {
                $this->db->bind($i, $value);
                $i++;
            }
        } else {
            // siapkan query awal
            $this->db->query($query);
        }
    }

    /**
     * Mengambil semua baris data yang cocok dari hasil query.
     *
     * @return array Array berisi semua baris data yang cocok.
     */
    public function fetchAll(): array
    {
        return $this->db->resultSet();
    }

    /**
     * Mengambil satu baris data yang cocok dari hasil query.
     *
     * @return array Data baris yang cocok.
     */
    public function fetch(): array|bool
    {
        return $this->db->single();
    }

    /**
     * Memasukkan data baru ke dalam tabel.
     *
     * @param array $data Data yang akan dimasukkan dalam bentuk asosiatif array.
     * @return int Jumlah baris yang terpengaruh oleh operasi penambahan data.
     */
    public function insertData(array $data): int
    {
        /// INSERT INTO table VALUES(NULL, ?, ?, ?, ?, ...);

        // set array placeholder 
        $placeholders = [];
        foreach ($data as $value) {
            $placeholders[] = "?";
        }
        // gabungkan placeholder ? menjadi string
        $placeholdersStr = implode(', ', $placeholders);

        // init query
        $query = "INSERT INTO $this->table VALUES (NULL, $placeholdersStr)";

        // prepare query
        $this->db->query($query);

        // binding
        $i = 1;
        foreach ($data as $value) {
            $this->db->bind($i, $value);
            $i++;
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    /**
     * @param array $kondisi masukkan sebuah kondisi where untuk menghapus data contoh `["id" => 1]`
     * @return int rowCount (0 || (> 0))
     */
    public function deleteData(array $kondisi): int
    {
        // tangkap key dan value dari array kondisi
        $key = array_keys($kondisi)[0];
        $value = array_values($kondisi)[0];
        // init query
        $query = "DELETE FROM $this->table WHERE $key = ?";
        // prepare query
        $this->db->query($query);
        // binding 
        $this->db->bind(1, $value);
        // execute
        $this->db->execute();

        return $this->db->rowCount();
    }

    /**
     * Memperbarui data dalam tabel berdasarkan kondisi tertentu.
     *
     * @param array $update_values Data yang akan diperbarui dalam bentuk array asosiatif.
     * @param array $kondisi Kondisi WHERE dalam bentuk array (contoh: ["kolom =" => "nilai"]).
     * @return int Jumlah baris yang terpengaruh oleh operasi pembaruan data.
     */
    public function updateData(array $update_values, array $kondisi): int
    {
        // tangkap key dan value dari kondisi where
        $kondisi_key = array_keys($kondisi)[0];
        $kondisi_value = array_values($kondisi)[0];

        // set placeholder jadi : field = ?, field2 = ?
        $placeholders = implode(' = ?, ', array_keys($update_values)) . ' = ? ';

        // init query
        $query = "UPDATE $this->table SET $placeholders WHERE $kondisi_key = ?";

        // prepare query
        $this->db->query($query);

        // binding data
        $i = 1;
        foreach ($update_values as $value) {
            $this->db->bind($i, $value);
            $i++;
        }

        // binding where kondisi
        $this->db->bind($i, $kondisi_value);

        $this->db->execute();
        return $this->db->rowCount();
    }
}
