# Daily Cotton - Fabric Sales Management System 🧵

### 👤 Identitas Pengembang
- **Nama** : Muhamad Nabil Satriya Suntara
- **NIM** : 312410365
- **Kelas** : TI.24.A4
- **Mata Kuliah** : Pemrograman Web

---

## 🔗 Tautan Penting (Links)
- **🎥 Penjelasan Video (YouTube): https://youtu.be/LwVkodtdEac?si=6nHKwlOQ7P9BLKK-**
- **🌐 Website Demo:** 
---

## 🚀 Tentang Daily Cotton
**Daily Cotton** adalah solusi platform manajemen penjualan kain (Cotton Combed) berbasis web. Aplikasi ini dirancang untuk mendigitalisasi alur bisnis toko tekstil, mulai dari manajemen inventaris kain, proses pemesanan pelanggan, hingga pelaporan data transaksi bagi pemilik bisnis.

Daily Cotton hadir untuk menjawab tantangan efisiensi dalam transaksi jual-beli kain kiloan. Dengan sistem ini, toko dapat menerapkan aturan bisnis secara otomatis dan mengelola database pelanggan secara terintegrasi dalam satu dasbor.

---

[Image of MVC Architecture diagram for web applications]


## 📂 Struktur Proyek (MVC Pattern)
Aplikasi ini menggunakan arsitektur yang terorganisir untuk memisahkan logika bisnis, tampilan, dan aset:
# Daily Cotton - Fabric Sales Management System 🧵

### 👤 Identitas Pengembang
* **Nama** : Muhamad Nabil Satriya Suntara
* **NIM** : 312410365
* **Kelas** : TI.24.A4
* **Mata Kuliah** : Pemrograman Web

---

## 🚀 Tentang Daily Cotton
**Daily Cotton** adalah platform manajemen penjualan kain (Cotton Combed) berbasis web. Aplikasi ini mendigitalisasi alur bisnis toko tekstil, mulai dari katalog inventaris hingga pelaporan data transaksi bagi pengelola.

## 📂 Struktur Proyek (Architecture)
Aplikasi ini menggunakan pola struktur yang memisahkan logika (App), tampilan (Views), dan aset (Assets):

```
DAILY_COTTON/
├── app/
│   ├── Controller.php      # Logika utama (Routing & Data Handling)
│   └── Database.php        # Konfigurasi data (LocalStorage/DB)
├── assets/
│   ├── css/
│   │   └── style.css       # Kustomisasi gaya tampilan (UI/UX)
│   └── img/                # Media dan aset gambar produk
├── views/
│   ├── admin_home.php      # Dashboard utama untuk Admin
│   ├── data_pelanggan.php  # Database detail pesanan pelanggan
│   ├── login.php           # Halaman masuk (Sign In)
│   ├── registrasi.php      # Halaman pendaftaran (Sign Up)
│   ├── beli_detail.php     # Halaman checkout & detail produk
│   ├── riwayat.php         # Riwayat belanja sisi pelanggan
│   ├── struk_berhasil.php  # Template struk digital (Invoice)
│   └── user_home.php       # Katalog produk utama (Klien)
├── .htaccess               # Konfigurasi URL Friendly
└── index.php               # Gerbang utama aplikasi
```

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


© 2026 **Daily Cotton Indonesia** - *Best Fabric, Best Quality.*
