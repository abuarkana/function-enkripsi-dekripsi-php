<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enkripsi dan Dekripsi ID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 70%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .content {
            margin: 20px 0;
        }
        .content .label {
            font-weight: bold;
            color: #333;
        }
        .content .value {
            display: block;
            margin-top: 10px;
            padding: 10px;
            background-color: #e9e9e9;
            border-radius: 4px;
            font-family: monospace;
            word-wrap: break-word;
        }
        .button {
            display: block;
            width: 100%;
            padding: 12px;
            text-align: center;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Enkripsi dan Dekripsi ID</h1>

        <?php
        // Fungsi untuk menghasilkan kunci dari password menggunakan PBKDF2
        function generate_key($password, $salt) {
            return hash_pbkdf2('sha256', $password, $salt, 10000, 32, true); // 32 bytes untuk AES-256
        }

        // Fungsi untuk URL-safe base64 encode
        function url_safe_base64_encode($data) {
            $encoded = base64_encode($data);
            return rtrim(strtr($encoded, '+/', '-_'), '='); // Ganti + dan / dengan karakter aman untuk URL dan hapus padding
        }

        // Fungsi untuk URL-safe base64 decode
        function url_safe_base64_decode($data) {
            $data = strtr($data, '-_', '+/'); // Ganti - dan _ dengan + dan /
            $padding = strlen($data) % 4; // Tentukan jumlah padding yang diperlukan
            if ($padding) {
                $data .= str_repeat('=', 4 - $padding); // Tambahkan padding jika perlu
            }
            return base64_decode($data);
        }

        // Fungsi enkripsi dengan AES-256-GCM untuk otentikasi dan enkripsi
        function encrypt($data, $password) {
            $method = 'aes-256-gcm';
            $salt = random_bytes(16); // Salt untuk PBKDF2
            $key = generate_key($password, $salt);
            $iv = random_bytes(openssl_cipher_iv_length($method)); // IV dengan panjang yang benar
            $tag = null;
            $encrypted = openssl_encrypt($data, $method, $key, 0, $iv, $tag); // Enkripsi data

            // Gabungkan data yang terenkripsi, IV, tag, dan salt dalam format JSON
            $result = json_encode([
                'data' => $encrypted,
                'iv' => url_safe_base64_encode($iv),
                'salt' => url_safe_base64_encode($salt),
                'tag' => url_safe_base64_encode($tag)
            ]);

            // Encode hasilnya dengan URL-safe Base64
            return url_safe_base64_encode($result);
        }

        // Fungsi dekripsi dengan AES-256-GCM
        function decrypt($encryptedData, $password) {
            $method = 'aes-256-gcm';

            // Decode data dari URL-safe Base64
            $data = json_decode(url_safe_base64_decode($encryptedData), true);
            if (!isset($data['data'], $data['iv'], $data['salt'], $data['tag'])) {
                return false; // Format data tidak valid
            }

            $iv = url_safe_base64_decode($data['iv']);
            $salt = url_safe_base64_decode($data['salt']);
            $tag = url_safe_base64_decode($data['tag']);

            // Generate kunci dari password dan salt
            $key = generate_key($password, $salt);

            // Dekripsi data
            $decrypted = openssl_decrypt($data['data'], $method, $key, 0, $iv, $tag);
            return $decrypted;
        }

        // Contoh penggunaan
        $password = 'Your_Key'; // Password untuk kunci enkripsi
        $id = 'ABC123'; // ID yang ingin dienkripsi

        // Enkripsi ID
        $encrypted_id = encrypt($id, $password);
        // Dekripsi ID
        $decrypted_id = decrypt($encrypted_id, $password);
        ?>

        <div class="content">
            <span class="label">Original ID:</span>
            <span class="value"><?php echo $id; ?></span>
        </div>

        <div class="content">
            <span class="label">Encrypted ID:</span>
            <span class="value"><?php echo $encrypted_id; ?></span>
        </div>

        <div class="content">
            <span class="label">Decrypted ID:</span>
            <span class="value"><?php echo $decrypted_id; ?></span>
        </div>

        <button class="button" onclick="location.reload()">Encrypt Again</button>
    </div>

</body>
</html>
