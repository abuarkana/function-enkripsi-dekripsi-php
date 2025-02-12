Enkripsi dan Dekripsi ID Menggunakan AES-256-GCM

Deskripsi

Proyek ini adalah implementasi enkripsi dan dekripsi ID menggunakan algoritma AES-256-GCM dalam PHP. Data yang dienkripsi dapat dengan aman dikodekan menggunakan URL-safe Base64 untuk digunakan dalam URL atau penyimpanan lainnya.

Fitur

- Menggunakan AES-256-GCM, yang lebih aman karena memiliki autentikasi bawaan.

- Key derivation menggunakan PBKDF2, dengan salt untuk meningkatkan keamanan.

- Mendukung URL-safe Base64 encoding, agar hasil enkripsi bisa digunakan dalam URL tanpa karakter yang tidak aman.

- Format JSON untuk penyimpanan data terenkripsi, termasuk IV, salt, dan authentication tag.

- Antarmuka sederhana, dengan tampilan berbasis HTML dan CSS.
