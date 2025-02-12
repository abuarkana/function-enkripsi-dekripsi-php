# 🔐 Enkripsi dan Dekripsi ID Menggunakan AES-256-GCM

## 📌 Deskripsi

Proyek ini adalah implementasi **enkripsi dan dekripsi ID** menggunakan algoritma **AES-256-GCM** dalam PHP. Data yang dienkripsi dikodekan menggunakan **URL-safe Base64**, sehingga aman untuk digunakan dalam URL atau penyimpanan lainnya.

---

## 🚀 Fitur Utama

✅ **Keamanan Tinggi**  
Menggunakan **AES-256-GCM**, yang memiliki autentikasi bawaan untuk mencegah manipulasi data.  

✅ **Key Derivation dengan PBKDF2**  
Menghasilkan kunci enkripsi yang lebih kuat dengan **salt** untuk meningkatkan keamanan.  

✅ **URL-safe Base64 Encoding**  
Hasil enkripsi dapat digunakan dalam URL tanpa karakter yang tidak aman.  

✅ **Format JSON**  
Data terenkripsi disimpan dalam format JSON yang mencakup:  
🔹 IV *(Initialization Vector)*  
🔹 Salt *(Salt tambahan untuk keamanan)*  
🔹 Authentication Tag *(Verifikasi integritas data)*  

✅ **Antarmuka Sederhana**  
Dilengkapi dengan tampilan berbasis **HTML & CSS** agar mudah digunakan.  

---

## 📥 Instalasi

**Clone Repository**  
```bash
git clone https://github.com/abuarkana/function-enkripsi-dekripsi-php.git

🔐 Cara Penggunaan
✨ Enkripsi Data
Gunakan fungsi encrypt() untuk mengenkripsi data dengan password rahasia.
<?php
include 'path/to/funtion-enkripsi-dekripsi-aes-cgm.php';

$data = '12345'; // ID atau data yang akan dienkripsi
$password = 'password_anda';

$encryptedData = encrypt($data, $password);
echo 'Hasil Enkripsi: ' . $encryptedData;
?>

🔓 Dekripsi Data
Gunakan fungsi decrypt() untuk mendekripsi data kembali ke bentuk aslinya.
<?php
include 'path/to/funtion-enkripsi-dekripsi-aes-cgm.php';

$encryptedData = 'data_terenkripsi';
$password = 'password_anda';

$decryptedData = decrypt($encryptedData, $password);
echo 'Hasil Dekripsi: ' . $decryptedData;
?>

🔒 Keamanan
✔️ Jangan menyimpan password enkripsi dalam kode sumber.
✔️ Gunakan salt yang unik untuk setiap enkripsi.
✔️ Pastikan data dienkripsi dan disimpan dengan aman.
