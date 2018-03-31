<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'third_party/vendor/autoload.php';

const DEFAULT_URL = 'https://test-99db3.firebaseio.com/';
const DEFAULT_TOKEN = 'DSVW60D3GXWMbGi9yKhv2wmaIVbW5H4PPdCX2jhd';
const DEFAULT_PATH = '/firebaseNode/example';

$firebase = new \Firebase\FirebaseLib(DEFAULT_URL, DEFAULT_TOKEN);

// --- storing an array ---
$test = array(
    "foo" => "bar",
    "i_love" => "lamp",
    "id" => 42
);
$dateTime = new DateTime();
$firebase->set(DEFAULT_PATH . '/' . $dateTime->format('c'), $test);

// --- storing a string ---
$firebase->set(DEFAULT_PATH . '/name/contact001', "John d");

// --- reading the stored string ---
$name = $firebase->get(DEFAULT_PATH . '/name/contact001');
echo $name;