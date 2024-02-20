<?php

class UserModel extends DBMysqli
{
    protected $table = 'user';

    private int $id;
    private string $username;
    private string $password;
    private string $email;
    private string $namalengkap;
    private string $alamat;

    public function get(string $role): array
    {
        return $this->query("SELECT * FROM $this->table WHERE Role = '$role'");
    }

    public function getById(int $id): array
    {
        return $this->query("SELECT * FROM $this->table WHERE UserID = $id")[0];
    }

    public function login($data): int|string
    {
        // ambil data
        $this->username = $data['username'];
        $this->password = $data['password'];

        // ambil data
        $row = $this->query("SELECT * FROM $this->table WHERE Username = '$this->username'")[0];

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
        $result = $this->query("SELECT * FROM $this->table WHERE Username = '$this->username'")[0];
        if (is_array($result)) return 'Username sudah terdaftar!';

        // cek panjang password apakah lebih dari 8 karakter
        if (strlen($this->password < 8)) return 'Password Terlalu Lemah!';

        // cek password konfirmasi
        if ($this->password == $data['konfirmasi_password']) {
            // enkripsi password
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);

            // insert data user
            mysqli_query($this->conn, "INSERT INTO $this->table VALUES(
                NULL, 
                '$this->username', 
                '$this->password', 
                '$this->email', 
                '$this->namalengkap',
                '$this->alamat',
                '$role'
            )");

            return (mysqli_affected_rows($this->conn) > 0) ?? 'Data user gagal register!';
        }

        return 'Konfirmasi password tidak valid!';
    }

    public function update(array $data)
    {
        // ambil data
        $this->email = htmlspecialchars($data['email']);
        $this->namalengkap = htmlspecialchars($data['namalengkap']);
        $this->alamat = htmlspecialchars($data['alamat']);
        $this->id = $data['id'];

        // insert data user
        mysqli_query($this->conn, "UPDATE $this->table SET 
            Email = '$this->email', 
            NamaLengkap = '$this->namalengkap', 
            Alamat = '$this->alamat' 
            WHERE UserID = $this->id");

        return (mysqli_affected_rows($this->conn) > 0) ?? 'Data Gagal Diubah!';
    }

    public function delete(int $id)
    {
        mysqli_query($this->conn, "DELETE FROM $this->table WHERE UserID = $id");
        return mysqli_affected_rows($this->conn);
    }

    public function updatePassword($data)
    {
        $passwordLama = $data['password_lama'];
        $passwordBaru = $data['password_baru'];
        $konfirmasiPassword = $data['password_konfirmasi'];
        $this->id = $_SESSION['user_id'];

        // ambil data user dari database
        $row = $this->query("SELECT * FROM $this->table WHERE UserID = $this->id")[0];

        // cek password lama dengan yang ada pada database
        if (!password_verify($passwordLama, $row['Password'])) {
            return 'Password lama salah!';
        }

        // cek konfirmasi password
        if ($passwordBaru !== $konfirmasiPassword) {
            return 'Konfirmasi password salah!';
        }

        // hash passwrod
        $passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);

        // update password
        mysqli_query($this->conn, "UPDATE $this->table SET Password = '$passwordBaru' WHERE UserID = $this->id");

        return mysqli_affected_rows($this->conn);
    }
}
