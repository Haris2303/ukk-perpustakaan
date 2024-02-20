<?php

class Flasher
{

  /**
   * @param string $pesan pesan dari sebuah flash
   * @param string $tipe terdapat beberapa tipe yaitu `success|warning|info|danger`
   * @param string $btnOK berikan charakter `'n'` tidak memunculkan tombol OK |`'y'` memunculkan tombol OK
   */
  public static function setFlash(string $pesan, string $tipe): array
  {
    return $_SESSION['flash'] = [
      'pesan' => $pesan,
      'tipe'  => $tipe
    ];
  }

  // flash bootstrap
  public static function flashBoots()
  {
    if (isset($_SESSION['flash'])) {
      echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
              ' . $_SESSION['flash']['pesan'] . '
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              </button>
          </div>';
      unset($_SESSION['flash']);
    }
  }
}
