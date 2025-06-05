<?php

namespace Wmwallet\SDK\Encrypt;

use Exception;

class Encrypt
{
    /**
     * @var resource|array|string
     */
    private $publicKey;

    public function __construct($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @throws Exception
     */
    public static function toRsaPriKey(string $rsaPath)
    {
        if (empty($rsaPath)) {
            throw new Exception("secretPath or secretBytes is empty");
        }
        $pemData = file_get_contents($rsaPath);
        if ($pemData === false) {
            throw new Exception("read rsa file error: cannot read file");
        }
        $pubKey = openssl_pkey_get_public($pemData);
        if ($pubKey === false) {
            throw new Exception("decode secret pem error: not a valid public key");
        }
        $keyDetails = openssl_pkey_get_details($pubKey);
        if ($keyDetails === false || $keyDetails['type'] !== OPENSSL_KEYTYPE_RSA) {
            throw new Exception("decode secret pem failed: not RSA key");
        }
        return $pubKey;
    }

    /**
     * @throws Exception
     */
    public function encrypt($data): string
    {
        $success = openssl_public_encrypt($data, $encrypted, $this->publicKey);
        if (!$success) {
            throw new Exception("encrypt err: " . openssl_error_string());
        }
        return base64_encode($encrypted);
    }

    private function createHash(string $data): string
    {
        return hash('sha256', $data, true);
    }

    private function pkcs5Padding(string $text, int $blockSize): string
    {
        $pad = $blockSize - (strlen($text) % $blockSize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public function aesEncryptECB(string $secret, string $plainText): string
    {
        $key = $this->createHash($secret);
        $blockSize = 16;
        $paddedText = $this->pkcs5Padding($plainText, $blockSize);
        $cipherText = openssl_encrypt(
            $paddedText,
            'AES-256-ECB',
            $key,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING
        );
        return base64_encode($cipherText);
    }
}
