<?php

/* do NOT run this script through a web browser */
if (!isset($_SERVER["argv"][0]) || isset($_SERVER['REQUEST_METHOD'])  || isset($_SERVER['REMOTE_ADDR'])) {
   die("<br><strong>This script is only meant to run at the command line.</strong>");
}

if (defined('STDIN')) {
  $host = $argv[1];
  $community = $argv[2];
  $job = $argv[3];
  //sessors table oid
  //$tableOid = '.1.3.6.1.2.1.99.1.1';
  $oid = 'ENTITY-SENSOR-MIB::entPhySensorTable';
  $desc = 'ENTITY-MIB::entPhysicalDescr';

  $ar = new SNMP(SNMP::VERSION_2C, $host, $community);
  $res1 = $ar->walk($oid, true);
  $res2 =  $ar->walk($desc,true);
//  print_r($res1);
//  print_r($res2);
}

$final = array();

foreach ($res2 as $k2 => $v2) {
  foreach ($res1 as $k1 => $v1) {
    if  (strpos($k1, '1.1.') === 0)
    $final[$k2]['si'] = $v1;
    if  (strpos($k1, '1.2.') === 0)
    $final[$k2]['metric'] = $v1;
    if  (strpos($k1, '1.3.') === 0)
    $final[$k2]['precision'] = $v1;
    if  (strpos($k1, '1.4.') === 0)
    $final[$k2]['value'] = $v1;
    if  (strpos($k1, '1.5.') === 0)
    $final[$k2]['status'] = $v1;
    if  (strpos($k1, '1.6.') === 0)
    $final[$k2]['units'] = $v1;
    $final[$k2]['description'] = $v2;
  }
}


function define_job ($job) {
  $res = array();
    if (strpos($job, 'temp') === 0 ) {
      if (strpos($job, ':all') !== false) {
        $res['front']['value'] = '100006001';
        $res['fan1'] = '100006002';
        $res['fan2'] = '100006003';
        $res['psu1'] = '100711101';
        $res['psu2'] = '100721101';
      }
      else {
        $exp_job = explode(':', $job);
        unset($exp_job[0]);
        foreach ($exp_job as $v3) {
        	$res['rand_' . generateRandomString(10)] = $v3;
        }
      }     
    }
    return $res;
}


function execute_job ($ar) {
	print_r($ar);
	// comment
}

function apply_precision ($val, $p) {

}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


execute_job(define_job($job));