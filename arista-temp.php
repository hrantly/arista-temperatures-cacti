<?php

/* do NOT run this script through a web browser */
if (!isset($_SERVER["argv"][0]) || isset($_SERVER['REQUEST_METHOD'])  || isset($_SERVER['REMOTE_ADDR'])) {
   die("<br><strong>This script is only meant to run at the command line.</strong>");
}

if (defined('STDIN')) {
  $host = $argv[1];
  $community = $argv[2];
  //sessors table oid
  //$tableOid = '.1.3.6.1.2.1.99.1.1';
  $oid = 'ENTITY-SENSOR-MIB::entPhySensorTable';
  $desc = 'ENTITY-MIB::entPhysicalDescr';
  // // Front-panel temp sensor
  // $oid ='ARISTA-ENTITY-SENSOR-MIB::aristaEntSensorStatusDescr.100006001';
  // // Fan controller 1 sensor
  // $oid ='ARISTA-ENTITY-SENSOR-MIB::aristaEntSensorStatusDescr.100006002';
  // // Fan controller 2 sensor
  // $oid ='ARISTA-ENTITY-SENSOR-MIB::aristaEntSensorStatusDescr.100006003';
  // // Switch chip 1 sensor
  // $oid ='ARISTA-ENTITY-SENSOR-MIB::aristaEntSensorStatusDescr.100006004';
  // // VRM 1 temp sensor
  // $oid ='ARISTA-ENTITY-SENSOR-MIB::aristaEntSensorStatusDescr.100006005';
  // $oid ='ARISTA-ENTITY-SENSOR-MIB::aristaEntSensorStatusDescr.100711101';
  something

  // $a = snmprealwalk($host, $community, $oid);
  // var_dump($a);
  $ar = new SNMP(SNMP::VERSION_2C, $host, $community);
  $res = $ar->walk($oid, true);
  $res2 =  $ar->walk($desc,true);
  print_r($res);
  print_r($res2);
}

