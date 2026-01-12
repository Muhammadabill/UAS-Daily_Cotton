// Contoh di index.php atau file proses_login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($app->login($username, $password)) {
        // Berhasil login (header sudah diatur di fungsi login)
    } else {
        // Jika gagal, kembali ke login dengan pesan error
        header("Location: index.php?url=login&error=1");
        exit();
    }
}