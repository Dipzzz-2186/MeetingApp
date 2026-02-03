# Meeting Room Booking System

Aplikasi berbasis web untuk mengelola dan melakukan booking ruang meeting dengan sistem role **Super Admin**, **Admin**, dan **User**.  
Mendukung sistem **trial 10 hari** dan **akun berbayar** untuk perusahaan.

---

## 🎯 Tujuan Aplikasi
- Memudahkan perusahaan mengatur peminjaman ruang meeting
- Menghindari bentrok jadwal
- Memberikan kontrol penuh kepada admin dan super admin
- Mendukung multi-perusahaan

---

## 👥 Role & Hak Akses

### 1. Super Admin
Hak akses tertinggi.
- Login ke sistem
- Melihat seluruh data admin dari semua perusahaan
- Override / akses penuh ke seluruh sistem

---

### 2. Admin (Perusahaan)
Admin internal tiap perusahaan.
- Register akun
- Memilih tipe akun:
  - Trial (10 hari)
  - Permanent (Berbayar)
- Mengelola user perusahaan
- Menambahkan room meeting
- Mengatur jadwal (scheduling)
- Menerima notifikasi saat masa trial habis

---

### 3. User
Pengguna akhir (karyawan).
- Login
- Melihat dashboard
- Melihat daftar room yang tersedia
- Melakukan booking meeting room

---

## 🏢 Fitur Utama

- 🔐 Autentikasi & Role Management
- 🏢 Manajemen Room (nama, kapasitas)
- 📅 Scheduling & Booking
- ⏱️ Trial Management (10 hari)
- 💳 Sistem pembayaran (untuk akun permanent)
- 🔔 Notifikasi habis masa trial

---

## 🔄 Flowchart Sistem

Flowchart berikut menggambarkan alur sistem berdasarkan **Super Admin**, **Admin**, dan **User**.

### Diagram Alur (Mermaid)

```mermaid
flowchart TD
    %% SUPER ADMIN
    SA_Start([Mulai]) --> SA_Login[Login]
    SA_Login --> SA_Dashboard[Dashboard]
    SA_Dashboard --> SA_View[Melihat seluruh data admin semua perusahaan]
    SA_View --> SA_Override[Override akses seluruh sistem]
    SA_Override --> SA_End([Selesai])

    %% ADMIN
    A_Start([Mulai]) --> A_Register[Register]
    A_Register --> A_Permanent{Permanent}
    A_Permanent -- Tidak --> A_Trial[Trial 10 Hari]
    A_Permanent -- Iya --> A_Pay[Pembayaran]
    A_Trial --> A_Dashboard
    A_Pay --> A_Dashboard[Dashboard]

    A_Dashboard --> A_AddUser[Tambah User Perusahaan]
    A_AddUser --> A_AddRoom[Tambah Room]
    A_AddRoom --> A_RoomDetail[Isi Nama dan Kapasitas Room]
    A_RoomDetail --> A_Schedule[Scheduling]

    A_Schedule --> A_TrialCheck{Trial Habis}
    A_TrialCheck -- Tidak --> A_End([Selesai])
    A_TrialCheck -- Iya --> A_Notify[Notifikasi Pembayaran]
    A_Notify --> A_End

    %% USER
    U_Login[Login User] --> U_Dashboard[Dashboard User]
    U_Dashboard --> U_ViewRoom[Lihat Room Tersedia]
    U_ViewRoom --> A_Schedule

