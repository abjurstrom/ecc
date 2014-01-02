<?php
/**
 * Created by PhpStorm.
 * User: abjurstrom
 * Date: 1/2/14
 * Time: 3:52 PM
 */
require_once("NFSN/Exec.php");
nfsn_exec_set_secret("G9o2K5476yTtCPfPqt7s3YIWBqEJqQtIlZjic");

$output = array();
$return_status = array();
$output[] = getcwd();
chdir('/home/public/gitest/ecc');
$output[] = getcwd();

$return_status['reset'] = nfsn_exec('git reset --hard HEAD');
$return_status['pull'] = nfsn_exec('git pull https://github.com/abjurstrom/ecc.git master');

echo '<pre>';
print_r($output);
echo PHP_EOL;
var_dump($return_status['reset']);
echo PHP_EOL;
var_dump($return_status['pull']);
echo '</pre>';