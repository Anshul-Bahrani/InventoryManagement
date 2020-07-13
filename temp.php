<?php
require "helper\init.php";
$config = new Config();
// // echo $config->get("SMTPDebug");

$db = new Database($di);
// // print_r($db->readData("category", ["category_id", "category_name"]));
// // $db->delete("meta_data", "1");
// $data = [
//     'meta_data_id' => '1',
//     'created_at' => '2001-02-01',
//     'updated_at' => '2001-05-05',
//     'deleted' => '0'
// ];

// // $db->insert("meta_data", $data);

// echo $db->exists("meta_data", $data);
echo $di->get('util')->redirect('demo.php');