<?php
class Utils {
    public static function encrypt($data, $password) {
        return openssl_encrypt($data, 'AES-128-CTR', $password, 0, '1234567891011121');
    }

    public static function decrypt($data, $password) {
        return openssl_decrypt($data, 'AES-128-CTR', $password, 0, '1234567891011121');
    }

    public static function uploadImage($file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $targetDir = __DIR__ . '/../../public/uploads/';
            $fileName = time() . '-' . basename($file['name']);
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $fileName;
            }
        }
        return null;
    }
}
