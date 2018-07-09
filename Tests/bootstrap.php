<?php
if (file_exists(dirname(__FILE__, 2) . '/vendor/autoload.php')) {

    include_once dirname(__FILE__, 2) . '/vendor/autoload.php';
} else {
    throw  new Exception('No autoloader');
}

