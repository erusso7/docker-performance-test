#!/usr/bin/env php
<?php

define('KEY', 'SP0R9h76L4GH41Bx8T2Qr8sszusbur4P');
define('ALGORITHM', 'AES-256-CBC');
define('IV_LENGTH', openssl_cipher_iv_length(ALGORITHM));
define('THREAD', $argv[1]);
define('FOLDER', getenv('FOLDER'));
define('LIMIT', getenv('LIMIT'));

@mkdir(FOLDER, 0755, true);
$execution = $argv[1] ?? microtime();

for ($i = 0; $i < LIMIT; $i++) {
    $data = getData();
    $iv = getIV();
    $encrypted = encrypt($data, $iv);

    output($data, $iv, $encrypted);
    @unlink(FOLDER . DIRECTORY_SEPARATOR . $execution);
}

function getData(): string
{
    return random_bytes(100);
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
    $content =  bin2hex($data) . ' (' . bin2hex($iv) . '): ' . bin2hex($encrypted) . PHP_EOL;
    file_put_contents(FOLDER . DIRECTORY_SEPARATOR . THREAD, $content, FILE_APPEND);
}

