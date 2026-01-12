# Daily Cotton - Fabric Sales Management System 🧵

### 👤 Identitas Pengembang
- **Nama** : Muhamad Nabil Satriya Suntara
- **NIM** : 312410365
- **Kelas** : TI.24.A4
- **Mata Kuliah** : Pemrograman Web

---

## 🚀 Tentang Daily Cotton
**Daily Cotton** adalah solusi platform manajemen penjualan kain (Cotton Combed) berbasis web. Aplikasi ini dirancang untuk mendigitalisasi alur bisnis toko tekstil, mulai dari manajemen inventaris kain, proses pemesanan pelanggan, hingga pelaporan data transaksi bagi pemilik bisnis.

Daily Cotton hadir untuk menjawab tantangan efisiensi dalam transaksi jual-beli kain kiloan. Dengan sistem ini, toko dapat menerapkan aturan bisnis secara otomatis dan mengelola database pelanggan secara terintegrasi dalam satu dasbor.



[Image of MVC Architecture diagram for web applications]


## 📂 Struktur Proyek (MVC Pattern)
Aplikasi ini menggunakan arsitektur yang terorganisir untuk memisahkan logika bisnis, tampilan, dan aset:

* **`app/`**: Berisi `Controller.php` yang berfungsi sebagai logika utama aplikasi dan pengatur alur data.
* **`assets/`**: Menyimpan file pendukung seperti `style.css` dan gambar untuk antarmuka pengguna.
* **`views/`**: Folder pusat semua tampilan (User Interface):
    * `admin_home.php`: Dasbor utama pengelola.
    * `beli_detail.php`: Halaman checkout dengan sistem validasi minimal 1.5kg.
    * `login.php`: Gerbang autentikasi pengguna.
    * `riwayat.php`: Log transaksi pelanggan.
    * `data_pelanggan.php`: Database pesanan masuk untuk admin.
* **`.htaccess` & `index.php`**: Mengatur sistem routing agar URL aplikasi terlihat bersih.

## ✨ Fitur Utama
### 🛒 Sisi Pelanggan
- **Katalog Terintegrasi**: Pemilihan varian kain berdasarkan warna dan ketebalan (GSM).
- **Smart Validation**: Sistem secara otomatis menolak pembelian di bawah **1.5 Kg**.
- **Digital Receipt**: Pembuatan struk otomatis sebagai bukti transaksi yang sah.
- **Riwayat Belanja**: Akses penuh bagi pelanggan untuk memantau transaksi masa lalu.

### 🔐 Sisi Admin
- **Database Pelanggan**: Mencatat riwayat belanja setiap pembeli secara mendetail.
- **Monitoring Pesanan**: Pantauan real-time untuk setiap pesanan yang masuk (ID, Produk, Total Bayar).
- **Reset Data**: Fitur pemeliharaan untuk membersihkan riwayat transaksi.

## 🛠️ Teknologi yang Digunakan
- **Backend**: PHP (MVC Pattern)
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla JS)
- **CSS Framework**: Bootstrap 5.3
- **Icons**: Bootstrap Icons
- **Storage**: Web Storage API (LocalStorage)

## ⚙️ Cara Instalasi (Lokal)
1. Pastikan Anda memiliki environment PHP (seperti XAMPP atau Laragon).
2. Clone repositori ini ke dalam direktori root server Anda (misal: `htdocs`).
3. Akses melalui browser di alamat `http://localhost/DAILY_COTTON`.

---
© 2026 **Daily Cotton Indonesia** - *Best Fabric, Best Quality.*
