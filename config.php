<?php
require 'environment.php';
global $config;
$config=array();
if (ENVIRONMENT=='development') {
   $config['dbmaster'] = 'master';
   $config['dbname'] = 'union';
   $config['host']   = '127.0.0.1:3308';
   $config['dbuser'] = 'root';
   $config['dbpass'] = 'apta';
   $config['dbname2'] = 'union';
   $config['host2']   = '127.0.0.1:3308';
   $config['dbuser2'] = 'root';
   $config['dbpass2'] = 'apta';
} else {
   $config['dbmaster'] = 'master';
   $config['dbname'] = 'union';
   $config['host']   = '172.16.0.6';
   $config['dbuser'] = 'root';
   $config['dbpass'] = 'abacaxi';
   $config['dbname2'] = 'union';
   $config['host2']   = '127.0.0.1:3308';
   $config['dbuser2'] = 'root';
   $config['dbpass2'] = 'apta';
}