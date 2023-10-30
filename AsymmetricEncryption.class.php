<?php

/**
* https://github.com/jrmro/AsymmetricEncryption
* 
* This PHP class provides methods for generating public/private key pairs and performing asymmetric encryption and decryption using OpenSSL. 
*
* Example Usage:
*
* include 'AsymmetricEncryption.class.php'; // Include the AsymmetricEncryption class
*
* $encryptor = new AsymmetricEncryption();
*
* // Generate a new pair of keys
* $keys = $encryptor->generateKeys(); 
* echo "Public key: {$keys['public_key']}\n";
* echo "Private key: {$keys['private_key']}\n";
*
* // Encrypt the data with the public key
* $encrypted_data = $encryptor->encrypt("Hello, this is a test message.", $keys['public_key']); 
* echo "Encrypted Data: {$encrypted_data}\n";
* 
* // Decrypt the data with the private key
* $decrypted_data = $encryptor->decrypt($encrypted_data, $keys['private_key']);
* echo "Decrypted Data: {$decrypted_data}\n";
*
* @license    MIT License
* @author     Joseph Romero
* @version    1.0
* ...
*/

class AsymmetricEncryption 
{

    public function generateKeys($private_key_bits = 2048, $private_key_type = OPENSSL_KEYTYPE_RSA) 
    {
        $key_pair = openssl_pkey_new([
            "private_key_bits" => $private_key_bits,
            "private_key_type" => $private_key_type,
        ]);

        if ($key_pair === false) {
            throw new Exception(openssl_error_string());
        }

        openssl_pkey_export($key_pair, $private_key);
        $public_key = openssl_pkey_get_details($key_pair)['key'];

        return [ 
            'public_key' => $public_key, 
            'private_key' => $private_key 
        ];
    }

    public function encrypt($data, $public_key) 
    {
        openssl_public_encrypt($data, $encrypted, $public_key);
        return base64_encode($encrypted);
    }

    public function decrypt($encrypted, $private_key) 
    {
        $encrypted = base64_decode($encrypted);
        openssl_private_decrypt($encrypted, $decrypted, $private_key);
        return $decrypted;
    }
    
}
