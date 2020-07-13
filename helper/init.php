<?php
session_start();
require_once(__DIR__ ."/requirements.php");

$di = new DependencyInjector();
$di->set("config", new Config());
$di->set("database", new Database($di));
$di->set("hash", new Hash());
$di->set("errorhandler", new ErrorHandler());
$di->set("validator", new Validator($di));
$di->set("util", new Util($di));
$di->set('category', new Category($di));
$di->set('customer', new Customer($di));
$di->set('employee', new Employee($di));
$di->set('product', new Product($di));
$di->set('address', new Address($di));
$di->set('sales', new Sales($di));
$di->set('purchase', new Purchase($di));

// $di->set('product', new Product($di));
$di->set('supplier', new Supplier($di));
require_once "constants.php";