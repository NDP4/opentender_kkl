# 📋 OpenTender KKL

> Platform tender digital untuk Kuliah Kerja Lapangan (KKL) D3 Teknik Informatika UDINUS

![OpenTender KKL Banner](public/images/undraw_business-deal_nx2n.svg)

## 🌟 Fitur Utama

-   🔐 Sistem autentikasi multi-role (Admin & Biro Perjalanan)
-   📝 Manajemen proposal tender
-   📁 Upload dan verifikasi dokumen
-   📢 Sistem pengumuman
-   📧 Notifikasi email otomatis
-   📱 Responsif di semua perangkat

## 💻 Tech Stack

-   **Framework:** Laravel 11
-   **Frontend:** Blade + TailwindCSS
-   **Database:** MySQL
-   **Authentication:** Laravel Breeze
-   **File Storage:** Laravel Storage
-   **Mail:** SMTP Support
-   **Validasi:** reCAPTCHA v2

## 🚀 Instalasi

1. Clone repository

```bash
git clone https://github.com/yourusername/opentender-kkl.git
cd opentender-kkl
```

2. Install dependencies

```bash
composer install
npm install
```

3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

4. Konfigurasi database di .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=opentender_kkl
DB_USERNAME=root
DB_PASSWORD=
```

5. Migrate database

```bash
php artisan migrate
```

6. Link storage

```bash
php artisan storage:link
```

7. Jalankan aplikasi

```bash
npm run dev
php artisan serve
```

## 📝 Penggunaan

### Admin

-   Mengelola pengumuman tender
-   Review proposal biro perjalanan
-   Mengatur kontak informasi
-   Melihat history proposal

### Biro Perjalanan

-   Registrasi akun
-   Submit proposal tender
-   Upload dokumen persyaratan
-   Melihat status proposal
-   Menerima notifikasi

## 🤝 Kontribusi

Proyek ini terbuka untuk kontribusi dengan syarat:

1. Fork repository ini
2. Buat branch baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

> ⚠️ **Penting**: Harap hubungi pemilik repository sebelum melakukan perubahan besar.

## 📄 Lisensi

Repository ini adalah milik pribadi. Penggunaan atau modifikasi kode memerlukan izin dari pemilik.

## 👨‍💻 Pemilik

-   **Nama**: [Your Name]
-   **Email**: [Your Email]
-   **Github**: [@yourusername](https://github.com/yourusername)
-   **Program Studi**: D3 Teknik Informatika
-   **Universitas**: Universitas Dian Nuswantoro

## 📸 Screenshot

<details>
<summary>Landing Page</summary>

![Landing Page](path/to/screenshot1.png)

</details>

<details>
<summary>Dashboard Admin</summary>

![Admin Dashboard](path/to/screenshot2.png)

</details>

<details>
<summary>Form Proposal</summary>

![Proposal Form](path/to/screenshot3.png)

</details>

## 🙏 Terima Kasih Kepada

-   UDINUS
-   Program Studi D3 Teknik Informatika
-   Tim Pengembang Laravel
-   Kontributor Open Source
