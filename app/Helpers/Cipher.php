<?php

namespace App\Helpers;


class Cipher {
    private $key, $iv;
    function __construct() {
        $this->key = "franco";
        $this->iv = "1998102720190705";
    }
    function encrypt($text) {

        $crypttext = openssl_encrypt($text,"AES-256-CBC", $this->key,  0, $this->iv);

        return base64_encode($crypttext);
    }

    function decrypt($input) {
        $dectext = openssl_decrypt(base64_decode($input),"AES-256-CBC", $this->key, 0, $this->iv);
        return $dectext;
    }
}

?>