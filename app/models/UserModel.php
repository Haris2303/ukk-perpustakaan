<?php

class UserModel extends BaseModel
{
    protected $table = 'user';

    private string $username;
    private string $password;
    private string $email;
    private string $namalengkap;
    private string $alamat;

    public function __construct()
    {
        parent::__construct();
    }

    public function get(string $role): array
    {
        $this->selectData(kondisi: ['Role =' => $role]);
        return $this->fetchAll();
    }

    public function getById(int $id): array
    {
        $this->selectData(kondisi: ['UserID =' => $id]);
        return $this->fetch();
    }

    public function login($data): int|string
    {
        // ambil data
        $this->username = $data['username'];
        $this->password = $data['password'];

        // ambil data
        $this->selectData(kondisi: ['Username =' => $data['username']]);
        $row = $this->fetch();

        // cek username
        if (is_array($row)) {
            // cek password
            $dbPass = $row['Password'];

            if (password_verify($this->password, $dbPass)) {
                // initialisasi session
                $_SESSION['is_login'] = true;
                $_SESSION['NamaLengkap'] = $row['NamaLengkap'];
                $_SESSION['user_id'] = $row['UserID'];
                $_SESSION['Role'] = $row['Role'];
                return 1;
            }
        }
        return 0;
    }

    public function create(array $data, string $role)
    {
        // ambil data
        $this->username = htmlspecialchars($data['username']);
        $this->password = htmlspecialchars($data['password']);
        $this->email = htmlspecialchars($data['email']);
        $this->namalengkap = htmlspecialchars($data['namalengkap']);
        $this->alamat = htmlspecialchars($data['alamat']);

        // buat username jadi lowercase (huruf kecil)
        $this->username = strtolower($this->username);

        // cek username
        if ($this->isData(["Username" => $this->username])) return 'Username sudah terdaftar!';

        // cek panjang password apakah lebih dari 8 karakter
        if (strlen($this->password < 8)) return 'Password Terlalu Lemah!';

        // cek password konfirmasi
        if ($this->password == $data['konfirmasi_password']) {
            // insert data user
            $data = [
                "Username" => htmlspecialchars($this->username),
                "Password" => password_hash($this->password, PASSWORD_DEFAULT),
                "Email" => $this->email,
                "NamaLengkap" => $this->namalengkap,
                "Alamat" => $this->alamat,
                "Role" => $role
            ];

            return $this->insertData($data) ? 1 : 'Data user gagal register!';
        }

        return 'Konfirmasi password tidak valid!';
    }

    public function update(array $data)
    {
        // ambil data
        $this->email = htmlspecialchars($data['email']);
        $this->namalengkap = htmlspecialchars($data['namalengkap']);
        $this->alamat = htmlspecialchars($data['alamat']);

        // insert data user
        $dataUpdate = [
            "Email" => $this->email,
            "NamaLengkap" => $this->namalengkap,
            "Alamat" => $this->alamat
        ];

        return $this->updateData($dataUpdate, ['UserID' => $data['id']]) ? 1 : 'Data Gagal Diubah!';
    }

    public function delete(int $id)
    {
        return $this->deleteData(['UserID' => $id]);
    }

    public function updatePassword($data)
    {
        $passwordLama = $data['password_lama'];
        $passwordBaru = $data['password_baru'];
        $konfirmasiPassword = $data['password_konfirmasi'];

        // ambil data user dari database
        $this->selectData(kondisi: ['UserID =' => $_SESSION['user_id']]);
        $row = $this->fetch();

        // cek password lama dengan yang ada pada database
        if(!password_verify($passwordLama, $row['Password'])) {
            return 'Password lama salah!';
        }

        // cek konfirmasi password
        if($passwordBaru !== $konfirmasiPassword) {
            return 'Konfirmasi password salah!';
        }

        // hash passwrod
        $passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);

        // update password
        return $this->updateData(['Password' => $passwordBaru], ['UserID' => $_SESSION['user_id']]);
    }
}
