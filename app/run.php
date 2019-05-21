<?php

require "vendor/autoload.php";

// JSON formatted DNS records file
$record_file = '/app/config/dns_record.json';
$jsonResolver = new yswery\DNS\JsonResolver($record_file);

// Recursive resolver acting as a fallback to the JsonResolver
$recursiveResolver = new yswery\DNS\RecursiveResolver;

$stackableResolver = new yswery\DNS\StackableResolver(array($jsonResolver, $recursiveResolver));

// Creating a new instance of our class
//$dns = new yswery\DNS\Server($stackableResolver);



class ServerProxy extends yswery\DNS\Server {

    
    
    public function __construct($ds_storage, $bind_ip = '0.0.0.0', $bind_port = 53, $default_ttl = 300, $max_packet_len = 512)
    {
    
        parent::__construct($ds_storage, $bind_ip, $bind_port, $default_ttl, $max_packet_len);
        restore_error_handler();
    }




}

function run($stackableResolver) {
    try {
        $dns = new ServerProxy($stackableResolver);
        $dns->start();
    } catch (Exception $exc) {
        run($stackableResolver);
    }
}


run($stackableResolver);
?>