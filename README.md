# AI-Career Scanner System

Aplikasi rekrutmen modern berbasis AI yang dirancang untuk membantu HR menganalisis CV kandidat secara otomatis dan objektif menggunakan teknologi **OpenRouter AI**.

![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/tailwindcss-%2338B2AC.svg?style=for-the-badge&logo=tailwind-css&logoColor=white)
![OpenRouter AI](https://img.shields.io/badge/AI-OpenRouter_AI-purple?style=for-the-badge)

---

## ✨ Fitur Utama

### 👨‍💼 Sisi Admin (HR)
- **Management Control Center**: Kelola lowongan pekerjaan dengan desain futuristik.
- **Smart Analytics**: Melihat skor kecocokan (*match score*) setiap kandidat berdasarkan analisis AI.
- **Status Tracking**: Kelola status pelamar (Review, Interview, Rejected).

### 🧑‍💻 Sisi Pelamar (Candidate)
- **Job Exploration**: Jelajahi lowongan yang tersedia dengan indikator **"Urgent"** berbasis deadline.
- **AI CV Scanner**: Upload CV format PDF dan biarkan AI mengekstrak data serta menganalisis skill secara otomatis.
- **Application History**: Pantau riwayat lamaran beserta ringkasan alasan dari AI.

---

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12
- **Styling**: Tailwind CSS (Custom Dark Mode)
- **Database**: PostgreSQL
- **AI Engine**: OpenRouter
- **PDF Engine**: `smalot/pdfparser` untuk ekstraksi teks CV
- **Icons**: Heroicons & Lucide

---

## 🚀 Instalasi

### 1️⃣ Clone Repositori
```bash
git clone https://github.com/shofialafarah/cv-scanner.git
cd cv-scanner
```

### 2️⃣ Install Dependensi
```bash
composer install
npm install
npm run dev
```

### 3️⃣ Konfigurasi Environment
Salin file `.env.example` menjadi `.env`, lalu atur koneksi database dan API key:

```env
OPENROUTER_API_KEY=your_api_key_here
```

Generate application key:

```bash
php artisan key:generate
```

### 4️⃣ Migrasi Database
```bash
php artisan migrate
```

### 5️⃣ Jalankan Aplikasi
```bash
php artisan serve
```

---

## 📌 Catatan
Pastikan file CV yang diupload berformat **PDF** dan ukuran file sesuai batas upload server Anda.