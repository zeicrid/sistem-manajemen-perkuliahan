# Requirements Document

## Introduction

Sistem Manajemen Perkuliahan adalah aplikasi web berbasis CodeIgniter 4 yang dirancang untuk mengelola data akademik perguruan tinggi dengan database "kuliah". Sistem ini menggunakan arsitektur MVC dengan fitur autentikasi multi-role (admin, mahasiswa, dosen) untuk mengelola mahasiswa, dosen, mata kuliah, ruangan, jadwal, rencana studi, dan penilaian.

## Glossary

- **Sistem_Manajemen_Perkuliahan**: Aplikasi web utama menggunakan CodeIgniter 4 dengan database "kuliah"
- **Admin**: Pengguna dengan role admin yang mengelola CRUD mahasiswa, dosen, ruangan, dan jadwal
- **Mahasiswa**: Pengguna dengan role mahasiswa yang membuat rencana studi dan melihat hasil studi dengan IPK
- **Dosen**: Pengguna dengan role dosen yang melihat jadwal dan mengisi nilai mahasiswa
- **Database_Kuliah**: Database utama "kuliah" dengan 8 tabel dengan struktur dan relasi yang spesifik
- **IPK_Calculation**: Perhitungan IPK = total_nilai_mutu/total_sks dari rencana studi mahasiswa
- **Role_Based_Access**: Sistem akses berdasarkan role (admin, mahasiswa, dosen)
- **CRUD_Operations**: Operasi Create, Read, Update, Delete untuk data master

## Requirements

### Requirement 1

**User Story:** As a system developer, I want to create database "kuliah" with proper table structure, so that the academic data can be stored and managed effectively.

#### Acceptance Criteria

1. THE Sistem_Manajemen_Perkuliahan SHALL create Database_Kuliah with name "kuliah"
2. THE Sistem_Manajemen_Perkuliahan SHALL create mahasiswa table with nim CHAR(10) PK and nama VARCHAR(100)
3. THE Sistem_Manajemen_Perkuliahan SHALL create dosen table with nidn CHAR(10) PK and nama VARCHAR(100)
4. THE Sistem_Manajemen_Perkuliahan SHALL create mata_kuliah table with id_mata_kuliah INT PK AUTO_INCREMENT, kode_mata_kuliah VARCHAR(10), nama_mata_kuliah VARCHAR(100), and sks INT
5. THE Sistem_Manajemen_Perkuliahan SHALL create ruangan table with id_ruangan INT PK AUTO_INCREMENT and nama_ruangan VARCHAR(50)
6. THE Sistem_Manajemen_Perkuliahan SHALL create jadwal table with id INT PK AUTO_INCREMENT, nama_kelas VARCHAR(50), id_mata_kuliah INT FK, id_ruangan INT FK, nidn CHAR(10) FK, hari VARCHAR(10), and jam VARCHAR(10)
7. THE Sistem_Manajemen_Perkuliahan SHALL create rencana_studi table with id_rencana_studi INT PK AUTO_INCREMENT, nim CHAR(10) FK, id_jadwal INT FK, nilai_angka FLOAT, and nilai_huruf CHAR(2)
8. THE Sistem_Manajemen_Perkuliahan SHALL create nilai_mutu table with nilai_huruf CHAR(2) PK and nilai_mutu FLOAT
9. THE Sistem_Manajemen_Perkuliahan SHALL create user table with id_user INT PK AUTO_INCREMENT, nama_user VARCHAR(100), username VARCHAR(50), password VARCHAR(255), role ENUM('admin','mahasiswa','dosen'), and kode_peran VARCHAR(20)

### Requirement 2

**User Story:** As a system developer, I want to establish foreign key relationships between tables, so that data integrity is maintained across the database.

#### Acceptance Criteria

1. THE Sistem_Manajemen_Perkuliahan SHALL create foreign key from jadwal.id_mata_kuliah to mata_kuliah.id_mata_kuliah
2. THE Sistem_Manajemen_Perkuliahan SHALL create foreign key from jadwal.id_ruangan to ruangan.id_ruangan
3. THE Sistem_Manajemen_Perkuliahan SHALL create foreign key from jadwal.nidn to dosen.nidn
4. THE Sistem_Manajemen_Perkuliahan SHALL create foreign key from rencana_studi.nim to mahasiswa.nim
5. THE Sistem_Manajemen_Perkuliahan SHALL create foreign key from rencana_studi.id_jadwal to jadwal.id

### Requirement 3

**User Story:** As an Admin, I want to manage all master data through CRUD operations, so that I can maintain the academic system's core information.

#### Acceptance Criteria

1. WHEN Admin logs into the system, THE Sistem_Manajemen_Perkuliahan SHALL provide access to admin dashboard
2. THE Sistem_Manajemen_Perkuliahan SHALL allow Admin to perform CRUD_Operations on mahasiswa data
3. THE Sistem_Manajemen_Perkuliahan SHALL allow Admin to perform CRUD_Operations on dosen data
4. THE Sistem_Manajemen_Perkuliahan SHALL allow Admin to perform CRUD_Operations on ruangan data
5. THE Sistem_Manajemen_Perkuliahan SHALL allow Admin to perform CRUD_Operations on jadwal data

### Requirement 4

**User Story:** As a Mahasiswa, I want to create rencana studi and view hasil studi with IPK calculation, so that I can manage my academic progress.

#### Acceptance Criteria

1. WHEN Mahasiswa logs into the system, THE Sistem_Manajemen_Perkuliahan SHALL display mahasiswa dashboard
2. THE Sistem_Manajemen_Perkuliahan SHALL allow Mahasiswa to create rencana studi by selecting available jadwal
3. THE Sistem_Manajemen_Perkuliahan SHALL allow Mahasiswa to view hasil studi from their own rencana studi
4. THE Sistem_Manajemen_Perkuliahan SHALL calculate IPK_Calculation using formula total_nilai_mutu/total_sks
5. THE Sistem_Manajemen_Perkuliahan SHALL restrict Mahasiswa to view only their own rencana studi and hasil studi

### Requirement 5

**User Story:** As a Dosen, I want to view my assigned jadwal and input grades for students, so that I can evaluate student performance.

#### Acceptance Criteria

1. WHEN Dosen logs into the system, THE Sistem_Manajemen_Perkuliahan SHALL display dosen dashboard
2. THE Sistem_Manajemen_Perkuliahan SHALL allow Dosen to view jadwal assigned to their nidn
3. THE Sistem_Manajemen_Perkuliahan SHALL allow Dosen to view list of mahasiswa enrolled in their jadwal
4. THE Sistem_Manajemen_Perkuliahan SHALL allow Dosen to input nilai_angka and nilai_huruf for mahasiswa
5. THE Sistem_Manajemen_Perkuliahan SHALL restrict Dosen access to only jadwal assigned to them

### Requirement 6

**User Story:** As a system user, I want role-based login authentication, so that I can access features appropriate to my role.

#### Acceptance Criteria

1. THE Sistem_Manajemen_Perkuliahan SHALL implement login system with Role_Based_Access
2. WHEN user logs in, THE Sistem_Manajemen_Perkuliahan SHALL validate credentials against user table
3. THE Sistem_Manajemen_Perkuliahan SHALL redirect Admin to admin dashboard after successful login
4. THE Sistem_Manajemen_Perkuliahan SHALL redirect Mahasiswa to mahasiswa dashboard after successful login
5. THE Sistem_Manajemen_Perkuliahan SHALL redirect Dosen to dosen dashboard after successful login

### Requirement 7

**User Story:** As a system administrator, I want the application to use CodeIgniter 4 MVC structure, so that the code is organized and maintainable.

#### Acceptance Criteria

1. THE Sistem_Manajemen_Perkuliahan SHALL organize controllers in Admin, Mahasiswa, and Dosen subdirectories
2. THE Sistem_Manajemen_Perkuliahan SHALL implement separate models for each database table
3. THE Sistem_Manajemen_Perkuliahan SHALL organize views in role-based directory structure
4. THE Sistem_Manajemen_Perkuliahan SHALL implement RoleFilter for access control
5. THE Sistem_Manajemen_Perkuliahan SHALL use database migrations and seeders for data management

### Requirement 8

**User Story:** As a system user, I want the application populated with simulation data, so that I can test all features with realistic scenarios.

#### Acceptance Criteria

1. THE Sistem_Manajemen_Perkuliahan SHALL populate database with sample mahasiswa data
2. THE Sistem_Manajemen_Perkuliahan SHALL populate database with sample dosen data
3. THE Sistem_Manajemen_Perkuliahan SHALL populate database with sample jadwal data
4. THE Sistem_Manajemen_Perkuliahan SHALL allow mahasiswa to enroll in multiple jadwal
5. THE Sistem_Manajemen_Perkuliahan SHALL allow dosen to grade mahasiswa in their assigned jadwal