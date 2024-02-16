<?php

class Pagination
{

    protected $db;
    protected $view;
    protected static $limit = 5;
    protected static $page;
    protected static $data;

    public function __construct(string $view, array $jumlahData, int $limit, int $page)
    {
        $this->db = new Database();
        $this->view = $view;
        self::$limit = $limit;
        self::$page = $page;
        self::$data = count($jumlahData);
    }

    /**
     * 
     * @method setPage (setting halaman dari pagination)
     * @var table&limit
     * @param string $table Nama tabel
     * @param int $limit Batas data yang diambil
     * @param array|null $where Klausa WHERE opsional
     * 
     */
    public function setPager(array $orderby = [], array $kondisi = null): array
    {
        $limit = self::$limit;
        $page = self::$page;
        $view = $this->view;

        $perPage = $limit;
        $offset = ($page - 1) * $perPage;

        $model = new BaseModel($view);
        $model->selectData(null, null, $orderby, $kondisi);
        $data = $model->fetchAll();

        return array_slice($data, $offset, $perPage);
    }

    /**
     * @param int $jumlah_pagination jumlah dari kiri dan kanan pagination yang tampil
     */
    public static function view(int $jumlahPagination = 3)
    {
        $page = self::$page;
        $jumlahPage = ceil(self::$data / self::$limit);
        $next = $page + 1; // tambahkan 1 setiap klik
        $prev = $page - 1; // kurangkan 1 setiap klik

        // set awal start and end page
        $startPage = 1;
        $endPage = $page + $jumlahPagination;

        // start pagination
        if ($page > $jumlahPagination) {
            $startPage = + ($page - $jumlahPagination);
        }

        // end pagination
        if (($page + $jumlahPagination) > $jumlahPage) {
            $endPage = $jumlahPage;
        }

        // kirimkan data
        $data = [
            "jumlah_page" => $jumlahPage,
            "next_page" => $next,
            "prev_page" => $prev,
            "start_page" => $startPage,
            "end_page" => $endPage,
            "page" => $page,
        ];

        // jika data lebih banyak dari limit munculkan view pagination
        if (self::$data > self::$limit) {
            $view = new Controller();
            return $view->view('pagination/default', $data);
        }
    }
}
