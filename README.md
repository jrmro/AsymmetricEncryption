# Asymmetric Encryption Class

This PHP class provides methods for generating public/private key pairs and performing asymmetric encryption and decryption using OpenSSL. 

(Note: For client-side JavaScript asymmetric encryption, see [https://github.com/jrmro/AsymmetricEncryptionJS](https://github.com/jrmro/AsymmetricEncryptionJS)).

## Sample Usage

```
include 'AsymmetricEncryption.class.php'; // Include the AsymmetricEncryption class

$encryptor = new AsymmetricEncryption();

// Generate a new pair of keys
$keys = $encryptor->generateKeys(); 
echo "Public key: {$keys['public_key']}\n";
echo "Private key: {$keys['private_key']}\n";

// Encrypt the data with the public key
$encrypted_data = $encryptor->encrypt("Hello, this is a test message.", $keys['public_key']); 
echo "Encrypted Data: {$encrypted_data}\n";

// Decrypt the data with the private key
$decrypted_data = $encryptor->decrypt($encrypted_data, $keys['private_key']);
echo "Decrypted Data: {$decrypted_data}\n";
```

## Note
* This class uses OpenSSL for encryption and decryption. Make sure OpenSSL is enabled in your PHP configuration.
* Handle and store the private key securely. Do not expose it or hardcode it in your project.

## Author
Joseph Romero

## License
This code is released under the MIT License.
