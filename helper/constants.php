<?php
define('BASEURL',$di->get('config')->get('base_url'));
define('BASEASSETS',BASEURL."assets/");
define('BASEPAGES',BASEURL."views/pages/");

define("ADD_ERROR","add_error");
define("ADD_SUCCESS","add_success");

define("EDIT_ERROR","edit_error");
define("EDIT_SUCCESS","edit_success");

define("DELETE_ERROR","delete_error");
define("DELETE_SUCCESS","delete_success");

define("VALIDATION_ERROR","validation_error");
?>