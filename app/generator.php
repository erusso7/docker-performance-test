#!/usr/bin/env php
<?php
include 'vendor/autoload.php';

define('KEY', 'SP0R9h76L4GH41Bx8T2Qr8sszusbur4P');
define('ALGORITHM', 'AES-256-CBC');
define('IV_LENGTH', openssl_cipher_iv_length(ALGORITHM));
define('FILE', $argv[1]);
define('DESTINATION', __DIR__ . DIRECTORY_SEPARATOR . $argv[2]);
define('LIMIT', $argv[3]);

@mkdir(DESTINATION, 0755, true);
$execution = isset( $argv[1] ) ? $argv[1] : microtime();

for ($i = 0; $i < LIMIT; $i++) {
  $data      = getData();
  $iv        = getIV();
  $encrypted = encrypt($data, $iv);

  output($data, $iv, $encrypted);
  @unlink(DESTINATION . DIRECTORY_SEPARATOR . $execution);
}

function getData():string
{
  return \Ramsey\Uuid\Uuid::uuid4();
}

function getIV()
{
  return openssl_random_pseudo_bytes(IV_LENGTH);
}

function encrypt(string $data, $iv)
{
  return openssl_encrypt($data, ALGORITHM, KEY, OPENSSL_RAW_DATA, $iv);
}

function output($data, $iv, $encrypted)
{
  $content = $data . ' (' . bin2hex($iv) . '): ' . bin2hex($encrypted) . PHP_EOL;
  file_put_contents(DESTINATION . DIRECTORY_SEPARATOR . FILE, $content, FILE_APPEND);
}

